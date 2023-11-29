<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use DateTime;
use Faker\Factory;
use App\Entity\Wod;
use App\Entity\Type;
use App\Entity\User;
use App\Entity\Comment;
use App\Entity\Category;
use App\Entity\Exercice;
use App\Entity\Like;
use App\Entity\Quantity;
use App\Entity\Unity;
// use App\Entity\Repetition;
use App\Entity\WodRepetition;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Création de plusieurs CATEGORIES
        $categoryNames = [
            'Haut du corps',
            'Bas du corps',
            'Full body'
        ];



        foreach ($categoryNames as $name) {
            $category = new Category();
            $category->setName($name);

            $manager->persist($category);
        }

        $manager->flush();


        // $repetitions = [5, 10, 15, 20, 25, 30];

        // Création de plusieurs REPETITIONS
        // for($i = 0; $i < 50; $i++) {
        //     $repetition = new Repetition();
        // $repetition->setRepetition($faker->randomElement($repetitions));

        //     $manager->persist($repetition);
        // }

        // $manager->flush();


        // Création de plusieurs EXERCICES
        $exerciceBas = [
            "Squats" => "Pour effectuer un squat correctement, positionnez vos pieds à la largeur des épaules, fléchissez les hanches et les genoux en gardant le dos droit, descendez jusqu'à ce que vos cuisses soient parallèles au sol, puis remontez en poussant à travers vos talons tout en maintenant une respiration régulière. Assurez-vous que vos genoux restent alignés avec vos pieds pour éviter les blessures.",

            "Squats sauté" => "Pour effectuer des squats sautés, commencez en position debout, fléchissez les genoux pour descendre en squat, puis sautez verticalement en étendant les bras. À l'atterrissage, pliez à nouveau les genoux en position de squat pour un mouvement fluide et efficace.",

            "Squats sur une jambe" =>  "Pour effectuer des squats sur une jambe, levez une jambe devant vous et fléchissez le genou de la jambe restante en descendant le bassin vers le sol. Gardez le dos droit, puis remontez en contractant les muscles de la jambe travaillée. Alternez avec l'autre jambe pour équilibrer le travail musculaire.",

            "Fente avant" => "Pour effectuer une fente avant, commencez en position debout, puis faites un pas en avant avec une jambe tout en fléchissant les deux genoux jusqu'à ce que les deux jambes forment un angle de 90 degrés. Revenez à la position de départ et alternez avec l'autre jambe pour travailler les muscles des jambes et des fessiers.",

            "Fente Bulgare" => "Pour réaliser une fente bulgare, placez un pied en avant et l'autre en arrière sur un banc ou une surface surélevée. Fléchissez le genou avant tout en descendant le genou arrière vers le sol, puis remontez en poussant à travers le talon du pied avant. Alternez avec l'autre jambe pour travailler les muscles des jambes et des fessiers.",

            "Fente Latéral" => "Pour réaliser une fente latérale, tenez-vous debout avec les pieds écartés. Effectuez une fente latérale en déplaçant le poids sur une jambe tout en fléchissant le genou, puis revenez à la position debout et alternez avec l'autre jambe pour travailler les muscles des cuisses et des fessiers.",

            "Hip Trust" => "Pour effectuer un hip thrust au sol, allongez-vous sur le dos avec les genoux pliés et les pieds à plat sur le sol, écartés à la largeur des hanches. Soulevez les hanches vers le plafond en contractant les fessiers, puis redescendez en contrôlant le mouvement, en maintenant les épaules au sol pour cibler les muscles du bas du dos et des fessiers.",

            "Levé de Genoux" => "Pour effectuer un exercice de levé de genoux, tenez-vous debout avec les pieds à la largeur des épaules. Soulevez alternativement les genoux vers la poitrine en contractant les muscles abdominaux, en maintenant un rythme soutenu pour améliorer l'endurance cardiovasculaire."
        ];

        $exerciceHaut = [
            "Pompes" => "Pour faire une pompe, placez vos mains légèrement plus larges que la largeur des épaules, descendez en fléchissant les coudes tout en maintenant une ligne droite du cou aux talons, puis remontez en poussant à travers les paumes des mains. Assurez-vous de maintenir une forme correcte pour maximiser les bénéfices de l'exercice.",

            "Pompes diamant" => "Pour effectuer des pompes diamants, placez vos mains directement sous votre poitrine de manière à former un diamant avec vos pouces et vos index. Ensuite, descendez votre corps en fléchissant les coudes et poussez-vous vers le haut en utilisant la force de vos triceps et de votre poitrine.",

            "Pompes Mains écarté" => "Pour réaliser des pompes mains écartées, placez vos mains plus larges que la largeur des épaules en position de planche. Fléchissez les coudes pour descendre vers le sol, puis poussez-vous vers le haut en utilisant la force des muscles de la poitrine et des épaules tout en maintenant une ligne droite du corps.",

            "Tractions" => "Pour faire une traction, suspendez-vous à une barre avec les paumes tournées vers l'extérieur, puis soulevez votre corps en pliant les coudes jusqu'à ce que le menton soit au-dessus de la barre. Abaissez ensuite votre corps de manière contrôlée.",

            "Tractions Supination" => "Pour réaliser des tractions en supination, suspendez-vous à une barre avec les paumes tournées vers vous. Fléchissez les coudes pour soulever votre corps vers la barre, en gardant les paumes face à vous, puis redescendez de manière contrôlée pour cibler principalement les muscles du dos et des biceps.",

            "Traction Australienne" => "Pour effectuer une traction australienne, allongez-vous sous une barre de traction horizontale. Saisissez la barre avec les paumes tournées vers vous, fléchissez les coudes et tirez votre poitrine vers la barre tout en maintenant le corps droit, puis abaissez-vous lentement pour compléter une répétition, renforçant ainsi les muscles du dos et des bras.",

            "Dips sur chaise" => "Pour réaliser des dips sur chaise, placez vos mains sur le bord de la chaise, descendez votre corps en pliant les coudes jusqu'à ce que vos bras forment un angle d'environ 90 degrés. Ensuite, remontez en utilisant la force de vos bras, en veillant à maintenir une bonne posture du haut du corps.",
        ];

        $exerciceFull = [
            "Burpees" => "Pour réaliser un burpee, commencez en position debout, effectuez une flexion, placez vos mains au sol, sautez vos pieds en arrière en position de planche, effectuez une pompe, ramenez vos pieds vers vos mains, puis sautez verticalement en étendant les bras au-dessus de la tête. Répétez le mouvement de manière fluide pour un entraînement cardiovasculaire efficace.",

            "Saut à la corde" => "Pour effectuer un saut à la corde, tenez une extrémité de la corde dans chaque main et assurez-vous que la corde est ajustée à la longueur appropriée. Sautez en alternant rapidement vos pieds au-dessus de la corde, en maintenant un rythme régulier pour un exercice cardiovasculaire efficace.",

            "Gainage" => "Pour réaliser un gainage, commencez en position de planche avec les coudes directement sous les épaules et le corps formant une ligne droite des pieds à la tête. Maintenez cette position en contractant les muscles abdominaux et en évitant de laisser le bas du dos s'affaisser.",

            "Jumping Jack" => "Pour effectuer un jumping jack, commencez en position debout avec les pieds joints et les bras le long du corps. Ensuite, sautez en écartant les jambes sur le côté tout en levant les bras au-dessus de la tête, puis reviens à la position de départ en un mouvement fluide.",

            "Montains Climber" => "Pour réaliser un mountain climber, commencez en position de planche avec les mains directement sous les épaules. Ensuite, pliez alternativement les genoux vers la poitrine de manière dynamique, en maintenant une position stable du tronc pour travailler les muscles abdominaux et cardiovasculaires.",

            "La Chaise" => "Pour effectuer un exercice de la chaise, commencez par vous tenir debout avec les pieds écartés à la largeur des épaules. Descendez en position de squat, en fléchissant les genoux comme si vous vous asseyez sur une chaise invisible, et maintenez cette position pendant un certain temps pour renforcer les muscles des jambes."
        ];

        // Récupérez les exercices existants depuis la base de données
        // $repetitions = $manager->getRepository(Repetition::class)->findAll();

        $unitys = [
            "Répétitions",
            "Secondes"
        ];

        foreach ($unitys as $unity) {

            $unityx = new Unity();
            $unityx->setName($unity);

            $manager->persist($unityx);
        }



        //  Creation de quantité
        for ($i = 1; $i < 100; $i++) {
            $quantity = new Quantity();
            $quantity->setNumber($i);

            $manager->persist($quantity);
        }


        $category = $manager->getRepository(Category::class)->findAll();



        $imgPath = 'http://vivosjerome-server.eddi.cloud/src/DataFixtures/images/';

        $index = 1;

        foreach ($exerciceBas as $name => $description) {
            $exercice = new Activity();
            $exercice->setName($name)
                ->setDescription($description)
                ->setCategory($category[1])
                ->setImage($imgPath . "image" . $index . ".png");

            $manager->persist($exercice);

            $index++;
        }


        foreach ($exerciceFull as $name => $description) {
            $exercice = new Activity();
            $exercice->setName($name)
                ->setDescription($description)
                ->setCategory($category[2])
                ->setImage($imgPath . "image" . $index . ".png");

            $manager->persist($exercice);

            $index++;
        }


        foreach ($exerciceHaut as $name => $description) {
            $exercice = new Activity();
            $exercice->setName($name)
                ->setDescription($description)
                ->setCategory($category[0])
                ->setImage($imgPath . "image" . $index . ".png");

            $manager->persist($exercice);

            $index++;
        }

        $manager->flush();


        $hashedPassword = "$2y$13\$ya88RJdV.f7OYGsFIoUvLOZdNDm0Ne1F03rEYdtJ/tuJ72IBnkxaG";
        $hashedPasswordBernard = "$2y$13\$SoajX.v4sHVQa9O2zxm2rez..12LksMWSUEGdtlxr1DgncWtuJ0im";

        // Création d'un user admin
        $user = new User();
        $user->setUsername('admin')
            ->setPassword($hashedPassword)
            ->setMail('admin@gmail.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setAvatar(self::getRandomLoremPicsumImageURL());

        $manager->persist($user);

        // Création d'un user admin
        $user = new User();
        $user->setUsername('Bernard')
            ->setPassword($hashedPasswordBernard)
            ->setMail('bernard@atbernardo.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setAvatar(self::getRandomLoremPicsumImageURL());

        $manager->persist($user);

        // // Création de plusieurs USERS
        // for($i = 0; $i < 30; $i++) {
        //     $user = new User();
        //     $user->setUsername($faker->userName())
        //          ->setPassword($faker->sha256())
        //          ->setMail($faker->email())
        //          ->setAvatar(self::getRandomLoremPicsumImageURL());

        //     $manager->persist($user);

        // }


        // Création de plusieurs TYPES
        $typeNames = ['Tabata', 'HIIT'];

        foreach ($typeNames as $name) {
            $type = new Type();
            $type->setName($name);

            $manager->persist($type);
        }

        $manager->flush();

        // Création de plusieurs REPETITIONS
        for ($i = 1; $i < 11; $i++) {
            $repetition = new WodRepetition();
            $repetition->setRepetition($i);

            $manager->persist($repetition);
        }
        $manager->flush();


        // // Récupérez les repetition existants depuis la base de données
        // // $repetitions = $manager->getRepository(WodRepetition::class)->findAll();

        // // Récupérez les catégories existantes depuis la base de données creer juste avant
        // $categories = $manager->getRepository(Category::class)->findAll();

        // $wodRep = $manager->getRepository(WodRepetition::class)->findAll();

        // // Récupérez les auteurs existants depuis la base de données creer juste avant
        // $authors = $manager->getRepository(User::class)->findAll();

        // // Récupérez les types existants depuis la base de données creer juste avant
        // $types = $manager->getRepository(Type::class)->findAll();



        // // Créez des Wods en associant des types, des catégories et des auteurs existants
        // for ($i = 0; $i < 30; $i++) {
        //     $wod = new Wod();
        //     $wod->setName($faker->sentence(2))
        //         ->setImage(self::getRandomLoremPicsumImageURL())
        //         ->setDescription($faker->paragraph(1))
        //         ->setCreatedAt(new DateTime());


        //     // Sélectionnez un type au hasard parmi les types existants
        //     $randomWodRep = $wodRep[array_rand($wodRep)];
        //     $wod->setRepetition($randomWodRep);



        //     // Sélectionnez un type au hasard parmi les types existants
        //     $randomType = $types[array_rand($types)];
        //     $wod->setType($randomType);

        //     // Sélectionnez un auteur au hasard parmi les auteurs existants
        //     $randomAuthor = $authors[array_rand($authors)];
        //     $wod->setAuthor($randomAuthor);

        //     // Sélectionnez une catégorie au hasard parmi les catégories existantes
        //     $randomCategory = $categories[array_rand($categories)];
        //     $wod->setCategory($randomCategory);

        //     // Sélectionnez une repetition au hasard
        //     // // $randomRep = $repetitions[array_rand($repetitions)];
        //     // $wod->setRepetition($randomRep);

        //     $manager->persist($wod);
        // }


        // $manager->flush();

        // $unity = $manager->getRepository(Unity::class)->findAll();

        // $quantity = $manager->getRepository(Quantity::class)->findAll();

        // $activity = $manager->getRepository(Activity::class)->findAll();


        // $wod = $manager->getRepository(Wod::class)->findAll();


        // for($i = 0; $i < 100; $i++){

        //     $exo = new Exercice();

        //     // Sélectionnez une unity au hasard
        //     $randomUnity= $unity[array_rand($unity)];
        //     $exo->setUnity($randomUnity);

        //     // Sélectionnez une unity au hasard
        //     $randomQuantity= $quantity[array_rand($quantity)];
        //     $exo->setQuantity($randomQuantity);

        //     // Sélectionnez une unity au hasard
        //     $randomActivity= $activity[array_rand($activity)];
        //     $exo->setActivity($randomActivity);

        //     // Sélectionnez une unity au hasard
        //     $randomWod= $wod[array_rand($wod)];
        //     $exo->setWod($randomWod);

        //     $manager->persist($exo);
        // }

        // $manager->flush();

        // // Récupérez les catégories existantes depuis la base de données creer juste avant
        // $wods = $manager->getRepository(Wod::class)->findAll();

        // // Création de plusieurs COMMENTAIRES
        // for($i = 0; $i < 100; $i++) {
        //     $wod = new Comment();
        //     $wod->setContent($faker->paragraph(2));

        //     $randomAuthor = $authors[array_rand($authors)];
        //     $wod->setUser($randomAuthor);

        //     $randomwod = $wods[array_rand($wods)];
        //     $wod->setWod($randomwod);

        //     $manager->persist($wod);

        // }


        // // Récupérez les Wod existants depuis la base de données creer juste avant
        // $wods = $manager->getRepository(Wod::class)->findAll();

        // // Récupérez les Users existants depuis la base de données creer juste avant
        // $users = $manager->getRepository(User::class)->findAll();

        // // Créez des Wods en associant des types, des catégories et des auteurs existants
        // for ($i = 0; $i < 200; $i++) {
        //     $like = new Like();

        //     // Sélectionnez un userid au hasard parmi les users existants
        //     $randomWodId = $wods[array_rand($wods)];
        //     $like->setWod($randomWodId);

        //     // Sélectionnez un wodid au hasard parmi les wod existants
        //     $randomUserId = $users[array_rand($users)];
        //     $like->setUser($randomUserId);

        //     $manager->persist($like);

        // }
        // $manager->flush();
    }

    public static function getRandomLoremPicsumImageURL($width = 600, $height = 500)
    {
        $baseUrl = 'https://picsum.photos/';
        https: //picsum.photos/200/300?grayscale
        $randomImage = rand(1, 1000);
        $imageUrl = "{$baseUrl}/seed/{$randomImage}{$width}/{$height}";


        return $imageUrl;
    }
}
