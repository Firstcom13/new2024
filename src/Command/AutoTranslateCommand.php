<?php

namespace App\Command;

use Stichoza\GoogleTranslate\GoogleTranslate;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

#[AsCommand(name: 'app:auto-translate', description: 'Traduit automatiquement les clés du fichier messages.en.yaml')]
class AutoTranslateCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filePath = 'translations/messages.en.yaml'; // Vérifie que le chemin est bon pour ton projet

        if (!file_exists($filePath)) {
            $output->writeln('<error>Fichier messages.en.yaml introuvable. Lance translation:extract d\'abord.</error>');
            return Command::FAILURE;
        }

        // Charger le fichier YAML
        $translations = Yaml::parseFile($filePath);

        // Configuration Google Translate
        $tr = new GoogleTranslate('en'); // Cible : Anglais
        $tr->setSource('fr');            // Source : Français

        $newTranslations = [];
        $count = 0;

        $output->writeln('<info>Début de la traduction...</info>');

        if (is_array($translations)) {
            foreach ($translations as $key => $value) {
                // LOGIQUE AMÉLIORÉE :
                // On traduit SI :
                // 1. La valeur est vide
                // 2. OU la valeur est égale à la clé (comportement par défaut parfois)
                // 3. OU la valeur commence par "__" (ton problème actuel)

                $needsTranslation = empty($value)
                    || $value === $key
                    || str_starts_with($value, '__');

                if ($needsTranslation) {
                    try {
                        // On traduit la CLÉ (car c'est ton texte français)
                        $translated = $tr->translate($key);

                        // Petite sécurité pour les guillemets
                        $newTranslations[$key] = $translated;

                        $output->writeln(" Traduit : " . substr($key, 0, 30) . "... -> <comment>$translated</comment>");
                        $count++;
                    } catch (\Exception $e) {
                        $output->writeln("<error>Erreur sur '$key' : " . $e->getMessage() . "</error>");
                        $newTranslations[$key] = $value; // On garde l'ancien en cas d'erreur
                    }
                } else {
                    // Si c'est déjà traduit (une vraie phrase différente de la clé), on garde !
                    $newTranslations[$key] = $value;
                }
            }

            // Sauvegarder le fichier
            file_put_contents($filePath, Yaml::dump($newTranslations));
        }

        $output->writeln("<info>Terminé ! $count traductions effectuées ou mises à jour.</info>");

        return Command::SUCCESS;
    }
}
