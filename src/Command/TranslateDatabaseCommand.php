<?php

namespace App\Command;

use App\Entity\ArticlesBlog;
use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:translate-database')]
class TranslateDatabaseCommand extends Command
{
    public function __construct(private EntityManagerInterface $em)
    {
        parent::__construct();
    }

    /**
     * Cette fonction découpe le HTML en morceaux pour ne pas dépasser la limite de Google
     */
    private function translateLargeHtml(GoogleTranslate $tr, string $content): string
    {
        // Si le contenu est court (< 1500 chars), on traduit direct (c'est plus rapide)
        if (strlen($content) < 1500) {
            return $tr->translate($content);
        }

        // Sinon, on découpe intelligemment.
        // On utilise une Regex pour couper juste après les fermetures de balises principales (</p>, </div>, </h1>...)
        // Cela évite de couper une phrase en plein milieu ou de casser une balise HTML.
        $parts = preg_split('/(<\/p>|<\/div>|<\/h[1-6]>|<\/li>)/i', $content, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

        $translatedContent = '';
        $buffer = '';

        foreach ($parts as $part) {
            // On accumule les petits bouts dans un "buffer"
            // Tant que le buffer fait moins de 1500 caractères, on ajoute des morceaux.
            if (strlen($buffer . $part) < 1500) {
                $buffer .= $part;
            } else {
                // Le buffer est plein ! On traduit ce paquet et on le vide.
                if (!empty(trim($buffer))) {
                    $translatedContent .= $tr->translate($buffer);
                }
                $buffer = $part; // On commence le nouveau paquet
            }
        }

        // On n'oublie pas de traduire ce qui reste dans le buffer à la fin
        if (!empty(trim($buffer))) {
            $translatedContent .= $tr->translate($buffer);
        }

        return $translatedContent;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Récupérer tous les articles et catégories
        $articles = $this->em->getRepository(ArticlesBlog::class)->findAll();
        $categories = $this->em->getRepository(Categorie::class)->findAll();


        $tr = new GoogleTranslate('en');
        $tr->setSource('fr');

        foreach ($articles as $article) {
            $output->writeln("Traitement de : " . $article->getTitre());

            // --- TRADUCTION DU TITRE ---
            $article->setTranslatableLocale('en');

            // On traduit le titre français actuel
            $translatedTitle = $tr->translate($article->getTitre());
            $article->setTitre($translatedTitle);
            $output->writeln("Titre traduit : " . $translatedTitle);

            // --- TRADUCTION DU CONTENU ---
            // (Attention, si c'est du HTML, Google Translate peut casser les balises parfois)
            // Pour du texte brut c'est OK.
            if ($article->getContenu()) {
                $translatedContent = $this->translateLargeHtml($tr, $article->getContenu());
                $article->setContenu($translatedContent);
                $output->writeln("Contenu traduit " . substr($translatedContent, 0, 30) . "...");
            }

            // Le contenu 2
            if ($article->getContenu2()) {
                $translatedContent2 = $this->translateLargeHtml($tr, $article->getContenu2());
                $article->setContenu2($translatedContent2);
                $output->writeln("Contenu2 traduit " . substr($translatedContent2, 0, 30) . "...");
            }

            // La description courte
            if ($article->getDescriptionCourte()) {
                $translatedDesc = $tr->translate($article->getDescriptionCourte());
                $article->setDescriptionCourte($translatedDesc);
                $output->writeln("Description courte traduite " . substr($translatedDesc, 0, 30) . "...");
            }

            // On persiste. Gedmo va voir que la locale est 'en' et va
            // stocker ça dans la table de traduction au lieu d'écraser le français.
            $this->em->persist($article);
        }

        foreach ($categories as $category) {
            $output->writeln("Traitement de la catégorie : " . $category->getNom());

            $category->setTranslatableLocale('en');

            // Traduire le nom
            $translatedName = $tr->translate($category->getNom());
            $category->setNom($translatedName);
            $output->writeln("Nom traduit : " . $translatedName);

            $this->em->persist($category);
        }

        $this->em->flush();
        $output->writeln('Traduction terminée !');

        return Command::SUCCESS;
    }
}
