<?php

// src/DataPersister

namespace App\DataPersister;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $_entityManager;
    
    /**
     * encoder
     *
     * @var UserPasswordHasherInterface
     */
    private $_encoder;

    public function __construct(
        EntityManagerInterface $entityManager, UserPasswordHasherInterface $encoder
    )
    {
        $this->_entityManager = $entityManager;
        $this->_encoder = $encoder;
    }

    /**
     * {@inheritdoc}
     */
    
    public function supports($data, array $context = []): bool
    {
        return $data instanceof User;
    }

    public function persist($data, array $context = [])
    {
        // Si création on renvoie la date de création, sinon la date de modification
        if ($data->getCreatedAt()) {
            $data->setUpdatedAt(new \DateTimeImmutable());
        } else {
            $data->setCreatedAt(new \DateTimeImmutable());
            $data->setIsActive(true);
            //Si pas de mot de passe, c'est un opérateur et le mot de passe est son matricule
            if (!$data->getPassword()) {
                $hash=$this->_encoder->hashPassword($data,strval($data->getMatricule()));
                $data->setPassword($hash);
            }else{
                $hash=$this->_encoder->hashPassword($data,$data->getPassword());
                $data->setPassword($hash);
            }
        }
        $pseudo=strtolower(substr($data->getPrenom(),0,1).".".$data->getNom());
        $data->setUsername($pseudo);
        $data->setMail($pseudo."@daher.com");
        $data->setRoles($this->getChoiceRole($data));

        $this->_entityManager->persist($data);
        $this->_entityManager->flush();
    }

    public function remove($data, array $context = [])
    {
        $this->_entityManager->remove($data);
        $this->_entityManager->flush();
    }

    private function getChoiceRole($data): Array
    {
        // Déclaration variable de retour
        $roleUser=[];
        // Récupération des choix de poste et de service
        $poste=$data->getPoste()->getLibelle();
        $service=$data->getService()->getNom();
        // Suivant les choix, on va attribuer un profil à l'utilisateur
        switch ($service) {
            case "METHODES":
                if($poste == "Programmeur"){
                    $roleUser=['ROLE_METHODES','ROLE_PROGRAMMEUR'];
                } elseif ($poste == "Support") {
                    //dump($data->getPoste()->getLibelle());
                    $roleUser=['ROLE_METHODES','ROLE_DATATOOLS'];
                }else{
                    $roleUser=['ROLE_METHODES'];
                }
                break;
            case "MOYEN CHAUD":
                if($poste == "Maitrise"){
                    $roleUser=['ROLE_CE_POLYM'];
                }else{
                    $roleUser=['ROLE_REGLEUR'];
                }
                break;
            case "MOULAGE":
                if($poste == "Maitrise"){
                    $roleUser=['ROLE_CE_MOULAGE'];
                }elseif($data->getPoste()->getLibelle() == "Responsable"){
                    $roleUser=['ROLE_RESP_MOULAGE'];
                }  
                else{
                    $roleUser=['ROLE_MOULEUR'];
                }
                break;
            case "ASSEMBLAGE":
                if($poste == "Maitrise"){
                    $roleUser=['ROLE_CE_ASS'];
                }elseif($data->getPoste()->getLibelle() == "Responsable"){
                    $roleUser=['ROLE_RESP_ASS'];
                }  
                else{
                    $roleUser=['ROLE_AJUSTEUR'];
                }
                break;
            case "QUALITE":
                if($poste == "Maitrise"){
                    $roleUser=['ROLE_CE_QUALITE'];
                }elseif($data->getPoste()->getLibelle() == "Responsable"){
                    $roleUser=['ROLE_RESP_QUALITE'];
                }  
                else{
                    $roleUser=['ROLE_CONTROLEUR'];
                }
                break;
            case "LABO":
                if($poste == "Maitrise"){
                    $roleUser=['ROLE_CE_LABO'];
                }elseif($data->getPoste()->getLibelle() == "Responsable"){
                    $roleUser=['ROLE_RESP_LABO'];
                }  
                else{
                    $roleUser=['ROLE_CONTROLEUR_LABO'];
                }
                break;
            case "OUTILLAGE":
                if($poste == "Maitrise"){
                    $roleUser=['ROLE_CE_OUTIL'];
                }elseif($data->getPoste()->getLibelle() == "Responsable"){
                    $roleUser=['ROLE_RESP_OUTIL'];
                }  
                else{
                    $roleUser=['ROLE_OUTILLEUR'];
                }
                break;
            case "EXTERIEUR":
                $roleUser=['ROLE_USER'];
            break;
            case "ORDO":
                if($poste == "Responsable"){
                    $roleUser=['ROLE_CE_QUALITE'];
                }else{
                    $roleUser=['ROLE_GESTIONAIRE'];
                }
            break;
        }
        return $roleUser;
    }
}