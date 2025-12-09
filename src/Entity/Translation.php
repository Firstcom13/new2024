<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\Translation as BaseTranslation;

#[ORM\Table(name: 'ext_translations')]
#[ORM\Entity(repositoryClass: 'Gedmo\Translatable\Entity\Repository\TranslationRepository')]
class Translation extends BaseTranslation
{
    // On hérite de tout, on ne rajoute rien.
    // Cette classe sert juste à matérialiser la table dans ton projet.
}
