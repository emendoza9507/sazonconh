<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            [
                'title' => 'Los secretos de la cocina molecular',
                'content' => '<p>La cocina molecular es una disciplina que combina la ciencia y el arte culinario para crear experiencias gastronómicas únicas. Utilizando técnicas como la esferificación, la gelificación y la emulsificación, los chefs pueden transformar ingredientes comunes en obras maestras visuales y gustativas. <strong>Referencias:</strong> <a href="https://example.com/cocina-molecular">Cocina Molecular</a></p>',
                'slug' => 'los-secretos-de-la-cocina-molecular',
                'is_published' => true,
                'cover_image' => 'https://cdn.pixabay.com/photo/2015/03/01/16/02/beads-654823_1280.jpg',
                'user_id' => 1,
            ],
            [
                'title' => 'El arte de la presentación de platos',
                'content' => '<p>La presentación de platos es un aspecto crucial en la alta cocina. Un plato bien presentado no solo es visualmente atractivo, sino que también puede mejorar la percepción del sabor. Aprende a utilizar colores, texturas y formas para crear platos que deleiten todos los sentidos. <strong>Referencias:</strong> <a href="https://example.com/presentacion-platos">Presentación de Platos</a></p>',
                'slug' => 'el-arte-de-la-presentacion-de-platos',
                'is_published' => true,
                'cover_image' => 'https://img.freepik.com/free-photo/meat-carpaccio-with-white-cheese_140725-1393.jpg?t=st=1741944707~exp=1741948307~hmac=f9c8eb1c138e8c32b794dad49e46c9eff77e59a513f6f7db9901349dcd1536b6&w=740',
                'user_id' => 1,
            ],
            [
                'title' => 'Cocina saludable: ingredientes y técnicas',
                'content' => '<p>La cocina saludable no tiene por qué ser aburrida. Con los ingredientes adecuados y técnicas de cocción como el vapor y el horneado, puedes preparar comidas deliciosas y nutritivas. Descubre cómo incorporar superalimentos y reducir el uso de grasas y azúcares sin sacrificar el sabor. <strong>Referencias:</strong> <a href="https://example.com/cocina-saludable">Cocina Saludable</a></p>',
                'slug' => 'cocina-saludable-ingredientes-y-tecnicas',
                'is_published' => true,
                'cover_image' => 'https://img.freepik.com/free-photo/chef-kitchen-taking-notes_23-2148006685.jpg?t=st=1741944764~exp=1741948364~hmac=c0a6e79037401a196682f9ded64b1b41c27d11ab7bd93fd715179a4f099542f4&w=996',
                'user_id' => 1,
            ],
            [
                'title' => 'La magia de las especias en la cocina',
                'content' => '<p>Las especias son el alma de la cocina. Desde el azafrán hasta la cúrcuma, cada especia aporta un sabor y aroma únicos a los platos. Aprende a combinarlas para realzar el sabor de tus comidas y explorar nuevas dimensiones culinarias. <strong>Referencias:</strong> <a href="https://example.com/especias">Especias en la Cocina</a></p>',
                'slug' => 'la-magia-de-las-especias-en-la-cocina',
                'is_published' => true,
                'cover_image' => 'https://img.freepik.com/free-photo/top-view-different-seasonings-with-lemon-slices_140725-57541.jpg?t=st=1741944804~exp=1741948404~hmac=1526d082cd5e71df0abfe2d8f105c5957da08172c81108484d58fd68c6226cf1&w=740',
                'user_id' => 1,
            ],
            [
                'title' => 'Técnicas de cocción al vacío',
                'content' => '<p>La cocción al vacío es una técnica que permite cocinar los alimentos a baja temperatura durante un tiempo prolongado, preservando su sabor y textura. Descubre cómo esta técnica puede transformar tus platos y ofrecer una experiencia culinaria inigualable. <strong>Referencias:</strong> <a href="https://example.com/coccion-al-vacio">Cocción al Vacío</a></p>',
                'slug' => 'tecnicas-de-coccion-al-vacio',
                'is_published' => true,
                'cover_image' => 'https://img.freepik.com/free-photo/woman-make-dinner-kitchen-home_1157-34052.jpg?t=st=1741944863~exp=1741948463~hmac=bb856124bf0a3acd6f38ecdfa020416b7ec0e69a9ade04eb1a124bbfb94902a5&w=996',
                'user_id' => 1,
            ],
            [
                'title' => 'El uso de hierbas frescas en la cocina',
                'content' => '<p>Las hierbas frescas son un complemento perfecto para cualquier plato. Desde el perejil hasta el cilantro, cada hierba aporta un toque de frescura y sabor. Aprende a cultivarlas en casa y a utilizarlas para realzar tus recetas favoritas. <strong>Referencias:</strong> <a href="https://example.com/hierbas-frescas">Hierbas Frescas</a></p>',
                'slug' => 'el-uso-de-hierbas-frescas-en-la-cocina',
                'is_published' => true,
                'cover_image' => 'https://img.freepik.com/free-photo/modern-kitchen-composition-with-healthy-ingredients_23-2147859455.jpg?t=st=1741944907~exp=1741948507~hmac=a815500c4181cc373bfa03909b298165db8a4dce653338285ebfe12b8c39f7d6&w=996',
                'user_id' => 1,
            ],
            [
                'title' => 'Cocina internacional: sabores del mundo',
                'content' => '<p>La cocina internacional nos permite viajar sin salir de casa. Desde la pasta italiana hasta el sushi japonés, cada cultura ofrece una riqueza de sabores y técnicas. Descubre cómo incorporar estos sabores en tu cocina diaria. <strong>Referencias:</strong> <a href="https://example.com/cocina-internacional">Cocina Internacional</a></p>',
                'slug' => 'cocina-internacional-sabores-del-mundo',
                'is_published' => true,
                'cover_image' => 'https://img.freepik.com/free-photo/world-food-day-car-packed-spice-fresh-colors-placed-simulated-globe-brown-wooden-floor_1150-18928.jpg?t=st=1741944992~exp=1741948592~hmac=da5236ee60ad67dec3a593809bc8ce5eccfc3912a1b1356323a8f54ba021b737&w=996',
                'user_id' => 1,
            ],
            [
                'title' => 'Postres gourmet: técnicas y recetas',
                'content' => '<p>Los postres gourmet son el broche de oro de cualquier comida. Con técnicas como la temperación del chocolate y la elaboración de mousses, puedes crear postres que impresionen a tus invitados. <strong>Referencias:</strong> <a href="https://example.com/postres-gourmet">Postres Gourmet</a></p>',
                'slug' => 'postres-gourmet-tecnicas-y-recetas',
                'is_published' => true,
                'cover_image' => 'https://img.freepik.com/free-photo/front-view-chef-plating-dessert_23-2148794101.jpg?t=st=1741945025~exp=1741948625~hmac=273c43f5d2c402dd3ff70319d5142c799158738658fb05ebb5e2e4f5f62caa00&w=996',
                'user_id' => 1,
            ],
            [
                'title' => 'El maridaje perfecto: vinos y comida',
                'content' => '<p>El maridaje de vinos y comida es un arte que puede elevar cualquier experiencia gastronómica. Aprende a combinar diferentes tipos de vino con platos específicos para resaltar los sabores y crear una experiencia inolvidable. <strong>Referencias:</strong> <a href="https://example.com/maridaje">Maridaje de Vinos</a></p>',
                'slug' => 'el-maridaje-perfecto-vinos-y-comida',
                'is_published' => true,
                'cover_image' => 'https://img.freepik.com/free-photo/meat-carpaccio-with-vegetables-red-wine_140725-4806.jpg?t=st=1741945058~exp=1741948658~hmac=f585ef146cdba808a7121f2330b19f339a2b1f4d17d4029ba648bd7dc9f20c30&w=740',
                'user_id' => 1,
            ],
            [
                'title' => 'Cocina vegana: recetas y beneficios',
                'content' => '<p>La cocina vegana es una opción saludable y sostenible. Con ingredientes como el tofu y la quinoa, puedes crear platos deliciosos y nutritivos. Descubre los beneficios de una dieta basada en plantas y cómo incorporarla en tu vida diaria. <strong>Referencias:</strong> <a href="https://example.com/cocina-vegana">Cocina Vegana</a></p>',
                'slug' => 'cocina-vegana-recetas-y-beneficios',
                'is_published' => true,
                'cover_image' => 'https://img.freepik.com/free-photo/mexican-food_23-2148024706.jpg?t=st=1741945112~exp=1741948712~hmac=fa127d2895687f06be117dd7b9cd127e6a339bc337aeee03249370ab3e367b21&w=996',
                'user_id' => 1,
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
