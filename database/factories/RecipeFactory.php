<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Recipe;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $url = 'http://localhost:8000/storage/images/examples/';

        $recipes = [
            [
                'title' => 'Croque-monsieur',
                'content' => 'Un délicieux sandwich chaud avec du jambon et du fromage.',
                'media' => $url . 'FR9QRJGTPPQgRj0AY7jc2ssrslp8zaBwBbABNPOX.jpg',
                'ingredients' => 'Pain de mie, jambon, fromage râpé, beurre',
                'tags' => 'sandwich, fromage, jambon',
                'status' => 'published',
            ],
            [
                'title' => 'Salade César',
                'content' => 'Une salade classique avec poulet grillé, croûtons et sauce César.',
                'media' => $url . 'AqHfoWWFwVkg4VytvOgHzykr5OhYUizGdDLXqZ4z.jpg',
                'ingredients' => 'Laitue, poulet grillé, croûtons, fromage parmesan, sauce César',
                'tags' => 'salade, poulet, croûtons',
                'status' => 'published',
            ],
            [
                'title' => 'Ratatouille',
                'content' => 'Un ragoût de légumes méditerranéens typique de la région Provence.',
                'media' => $url . 'rkS7p5E1vjlcei8cjPTxPcZ1UxFDVAkpJWMJ0PnW.jpg',
                'ingredients' => 'Aubergines, courgettes, poivrons, tomates, oignons',
                'tags' => 'végétarien, légumes, provençal',
                'status' => 'published',
            ],
            [
                'title' => 'Boeuf Bourguignon',
                'content' => 'Ragoût de bœuf braisé dans du vin rouge avec des légumes et des herbes.',
                'media' => $url . 'kI6PcnSdISEOPGPZ3s17zzwRLcxSlNnPffHp7B7N.jpg',
                'ingredients' => 'Bœuf, vin rouge, carottes, oignons, champignons',
                'tags' => 'viande, ragoût, français',
                'status' => 'published',
            ],
            [
                'title' => 'Tarte Tatin',
                'content' => 'Une tarte renversée avec des pommes caramélisées.',
                'media' => $url . 'zeat27ZnlwWZjyyd1pHdVqtzy87WtR3PlETcVXfg.jpg',
                'ingredients' => 'Pommes, pâte feuilletée, beurre, sucre',
                'tags' => 'dessert, pommes, sucré',
                'status' => 'published',
            ],
            [
                'title' => 'Quiche Lorraine',
                'content' => 'Une tarte salée aux lardons et à la crème.',
                'media' => $url . 'xQgaVk1wWbMG2WlqsHM84i9CjwDrNLlWj6Rm0Ibv.jpg',
                'ingredients' => 'Pâte brisée, lardons, crème fraîche, œufs, fromage',
                'tags' => 'tarte, lardons, fromage',
                'status' => 'published',
            ],
            [
                'title' => 'Soupe à l’oignon',
                'content' => 'Une soupe traditionnelle française avec des oignons caramélisés et du fromage fondu.',
                'media' => $url . '6x4W2GL0U1VoONqB7IyYCVn7UvNaqgWMn6CPmf55.jpg',
                'ingredients' => 'Oignons, bouillon de bœuf, pain, fromage râpé',
                'tags' => 'soupe, oignons, fromage',
                'status' => 'published',
            ],
            [
                'title' => 'Coq au vin',
                'content' => 'Un plat mijoté de poulet au vin rouge avec des légumes.',
                'media' => $url . 'oMcJOIvEeM61Pa8sifNkId23M8N28J6mYRA6MuAI.jpg',
                'ingredients' => 'Poulet, vin rouge, champignons, carottes, lardons',
                'tags' => 'volaille, mijoté, français',
                'status' => 'published',
            ],
            [
                'title' => 'Gratin Dauphinois',
                'content' => 'Un gratin de pommes de terre à la crème et au fromage.',
                'media' => $url . 'BiMXlxk5s0r7jfNwDp6LiIodms9wbpN5Z3sQXNup.jpg',
                'ingredients' => 'Pommes de terre, crème, ail, fromage râpé',
                'tags' => 'gratin, pommes de terre, fromage',
                'status' => 'published',
            ],
            [
                'title' => 'Tiramisu',
                'content' => 'Un dessert italien à base de mascarpone, de café et de cacao.',
                'media' => $url . '3TUKaNWb9PAnOLZqgpQOK3yxzuKCGjWyyceudWQO.jpg',
                'ingredients' => 'Mascarpone, café, biscuits cuillère, cacao, œufs',
                'tags' => 'dessert, italien, café',
                'status' => 'published',
            ],
            [
                'title' => 'Pizza Margherita',
                'content' => 'Une pizza classique avec tomate, mozzarella et basilic.',
                'media' => $url . 'w1ugEE7nvNDB4IqunvSKirGZSuDgGyeY1NYEVwux.jpg',
                'ingredients' => 'Pâte à pizza, tomates, mozzarella, basilic',
                'tags' => 'pizza, italien, fromage',
                'status' => 'published',
            ],
            [
                'title' => 'Pâtes Carbonara',
                'content' => 'Un plat de pâtes avec une sauce crémeuse aux lardons.',
                'media' => $url . 'zWSo7fgOwRaQHMUqzB7cJqbHpnsoS77Y3CoocIr2.jpg',
                'ingredients' => 'Pâtes, lardons, œufs, parmesan, poivre',
                'tags' => 'pâtes, italien, lardons',
                'status' => 'published',
            ],
            [
                'title' => 'Chili Con Carne',
                'content' => 'Un plat épicé à base de viande de bœuf et de haricots rouges.',
                'media' => $url . 'oUvpacyCITgSmO5B9D3vQ777Mcqpfmxdr1XnkLMz.jpg',
                'ingredients' => 'Bœuf haché, haricots rouges, tomates, épices',
                'tags' => 'épices, viande, mexicain',
                'status' => 'published',
            ],
            [
                'title' => 'Couscous Royal',
                'content' => 'Un plat traditionnel nord-africain avec semoule et viandes variées.',
                'media' => $url . 'Wus8njyHCgtkvxPr6kqomNxYgSwdqYvRJKVeBgsd.jpg',
                'ingredients' => 'Semoule, agneau, merguez, légumes',
                'tags' => 'couscous, oriental, épices',
                'status' => 'published',
            ],
            [
                'title' => 'Moussaka',
                'content' => 'Un plat grec à base d’aubergines et de viande hachée.',
                'media' => $url . 'w2y7VqUn4XZ62gsNRDHtKAWJ3CDhrr8XAYv6cnzy.jpg',
                'ingredients' => 'Aubergines, bœuf haché, tomates, béchamel',
                'tags' => 'aubergines, gratin, grec',
                'status' => 'published',
            ],
            [
                'title' => 'Paella',
                'content' => 'Un plat espagnol à base de riz, fruits de mer et safran.',
                'media' => $url . 'l3imlJ5nQ1qSLLUaVqyAGfLHqSxHZatavkclvX4D.jpg',
                'ingredients' => 'Riz, crevettes, moules, poulet, safran',
                'tags' => 'espagnol, riz, fruits de mer',
                'status' => 'published',
            ],
            [
                'title' => 'Baba au rhum',
                'content' => 'Un dessert moelleux imbibé de rhum et garni de chantilly.',
                'media' => $url . 'LqvLDhzyf8WVz0r3Xnlpbu4NDGh05Aawb21n705d.jpg',
                'ingredients' => 'Farine, œufs, sucre, rhum, chantilly',
                'tags' => 'dessert, alcool, sucré',
                'status' => 'published',
            ],
            [
                'title' => 'Fondant au chocolat',
                'content' => 'Un dessert fondant et chocolaté irrésistible.',
                'media' => $url . '6F7l5DFJiAgsxMbCOTF6W95WFxq60EWGaWoZnglQ.jpg',
                'ingredients' => 'Chocolat, beurre, sucre, œufs, farine',
                'tags' => 'chocolat, dessert, sucré',
                'status' => 'published',
            ],
        ];        

        static $recipes_index = 0;
        $recipe = $recipes[$recipes_index];
        $recipes_index = ($recipes_index + 1) % count($recipes);

        $user = User::inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'title' => $recipe['title'],
            'content' => $recipe['content'],
            'media' => $recipe['media'],
            'ingredients' => $recipe['ingredients'],
            'tags' => $recipe['tags'],
            'status' => $recipe['status'],
        ];
    }
}
