
<?php

$peliculas = [
    [
        "id" => 1,
        "nombre" => "Interestelar",
        "imagen" => "https://image.tmdb.org/t/p/w500/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg",
        "horarios" => ["16:00", "19:00", "22:00"],
        "sinopsis" => "Un grupo de astronautas viaja a través de un agujero de gusano en busca de un nuevo hogar para la humanidad.",
        "duracion" => 169,
        "director" => "Christopher Nolan",
        "reparto" => ["Matthew McConaughey", "Anne Hathaway", "Jessica Chastain"],
        "calificacion" => "+12",
        "valoracion" => 5,
        "genero" => "Ciencia ficción",
        "trailer" => "https://www.youtube.com/embed/zSWdZVtXT7E?si=I_tccouX7XqoWCo_"
    ],
    [
        "id" => 2,
        "nombre" => "Origen",
        "imagen" => "https://image.tmdb.org/t/p/w500/oYuLEt3zVCKq57qu2F8dT7NIa6f.jpg",
        "horarios" => ["17:00", "20:00", "22:30"],
        "sinopsis" => "Un ladrón especializado en infiltrarse en los sueños recibe una misión que podría cambiar su vida.",
        "duracion" => 148,
        "director" => "Christopher Nolan",
        "reparto" => ["Leonardo DiCaprio", "Joseph Gordon-Levitt", "Elliot Page"],
        "calificacion" => "+12",
        "valoracion" => 5,
        "genero" => "Ciencia ficción / Acción",
        "trailer" => "https://www.youtube.com/embed/YoHD9XEInc0?si=DfwxHN3aQGwrYaaa"
    ],
    [
        "id" => 3,
        "nombre" => "El caballero oscuro",
        "imagen" => "https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg",
        "horarios" => ["16:30", "19:30", "22:30"],
        "sinopsis" => "Batman se enfrenta al Joker, un criminal que amenaza con sumir Gotham en el caos.",
        "duracion" => 152,
        "director" => "Christopher Nolan",
        "reparto" => ["Christian Bale", "Heath Ledger", "Aaron Eckhart"],
        "calificacion" => "+13",
        "valoracion" => 5,
        "genero" => "Acción / Drama",
        "trailer" => "https://www.youtube.com/embed/EXeTwQWrcwY?si=l6kQuaxcyMOfcMr7"
    ],
    [
        "id" => 4,
        "nombre" => "Avatar",
        "imagen" => "https://image.tmdb.org/t/p/w500/kyeqWdyUXW608qlYkRqosgbbJyK.jpg",
        "horarios" => ["15:30", "18:30", "22:00"],
        "sinopsis" => "Un exmarine viaja a Pandora y se ve dividido entre cumplir su misión y proteger a sus habitantes.",
        "duracion" => 162,
        "director" => "James Cameron",
        "reparto" => ["Sam Worthington", "Zoe Saldaña", "Sigourney Weaver"],
        "calificacion" => "+13",
        "valoracion" => 5,
        "genero" => "Ciencia ficción / Aventura",
        "trailer" => "https://www.youtube.com/embed/5PSNL1qE6VY?si=GLVhYdSC8uLFDC3B"
    ],
    [
        "id" => 5,
        "nombre" => "Titanic",
        "imagen" => "https://image.tmdb.org/t/p/w500/9xjZS2rlVxm8SFx8kPC3aIGCOYQ.jpg",
        "horarios" => ["16:00", "19:30", "22:30"],
        "sinopsis" => "Dos jóvenes de mundos diferentes se enamoran a bordo del Titanic durante su fatídico viaje inaugural.",
        "duracion" => 195,
        "director" => "James Cameron",
        "reparto" => ["Leonardo DiCaprio", "Kate Winslet", "Billy Zane"],
        "calificacion" => "+13",
        "valoracion" => 5,
        "genero" => "Romance / Drama",
        "trailer" => "https://www.youtube.com/embed/CHekzSiZjrY?si=_AUQg3C4Gj88DpLV"
    ],
    [
        "id" => 6,
        "nombre" => "Jurassic Park",
        "imagen" => "https://image.tmdb.org/t/p/w500/b1xCNnyrPebIc7EWNZIa6jhb1Ww.jpg",
        "horarios" => ["15:00", "18:00", "21:30"],
        "sinopsis" => "Un parque temático con dinosaurios clonados se convierte en una pesadilla cuando sus sistemas de seguridad fallan.",
        "duracion" => 127,
        "director" => "Steven Spielberg",
        "reparto" => ["Sam Neill", "Laura Dern", "Jeff Goldblum"],
        "calificacion" => "+12",
        "valoracion" => 5,
        "genero" => "Aventura / Ciencia ficción",
        "trailer" => "https://www.youtube.com/embed/lc0UehYemQA?si=fHRvikMCnvyWy4rX"
    ],
    [
        "id" => 7,
        "nombre" => "Los Vengadores",
        "imagen" => "https://image.tmdb.org/t/p/w500/RYMX2wcKCBAr24UyPD7xwmjaTn.jpg",
        "horarios" => ["16:30", "19:30", "22:00"],
        "sinopsis" => "Los superhéroes más poderosos de la Tierra deben unir fuerzas para detener una invasión alienígena.",
        "duracion" => 143,
        "director" => "Joss Whedon",
        "reparto" => ["Robert Downey Jr.", "Chris Evans", "Scarlett Johansson"],
        "calificacion" => "+12",
        "valoracion" => 4,
        "genero" => "Acción / Aventura",
        "trailer" => "https://www.youtube.com/embed/eOrNdBpGMv8?si=SNBI6nOUP02s0J-c"
    ],
    [
        "id" => 8,
        "nombre" => "Harry Potter y la piedra filosofal",
        "imagen" => "https://image.tmdb.org/t/p/w500/wuMc08IPKEatf9rnMNXvIDxqP4W.jpg",
        "horarios" => ["15:30", "18:30", "21:30"],
        "sinopsis" => "Un niño descubre que es mago y comienza sus estudios en Hogwarts, una escuela llena de misterios.",
        "duracion" => 152,
        "director" => "Chris Columbus",
        "reparto" => ["Daniel Radcliffe", "Emma Watson", "Rupert Grint"],
        "calificacion" => "Todos los públicos",
        "valoracion" => 5,
        "genero" => "Fantasía / Aventura",
        "trailer" => "https://www.youtube.com/embed/VyHV0BRtdxo?si=JKCk3I56FVHhu5II"
    ],
    [
        "id" => 9,
        "nombre" => "Joker",
        "imagen" => "https://image.tmdb.org/t/p/w500/udDclJoHjfjb8Ekgsd4FDteOkCU.jpg",
        "horarios" => ["17:00", "20:00", "22:30"],
        "sinopsis" => "Arthur Fleck, un hombre marginado por la sociedad, comienza una transformación que lo convierte en el Joker.",
        "duracion" => 122,
        "director" => "Todd Phillips",
        "reparto" => ["Joaquin Phoenix", "Robert De Niro", "Zazie Beetz"],
        "calificacion" => "+18",
        "valoracion" => 4,
        "genero" => "Drama / Suspense",
        "trailer" => "https://www.youtube.com/embed/zAGVQLHvwOY?si=VwisRDhL5eCdfO_f"
    ],
    [
        "id" => 10,
        "nombre" => "Coco",
        "imagen" => "https://image.tmdb.org/t/p/w500/gGEsBPAijhVUFoiNpgZXqRVWJt2.jpg",
        "horarios" => ["15:00", "17:30", "20:00"],
        "sinopsis" => "Miguel sueña con ser músico y emprende una aventura en el mundo de los muertos para descubrir la historia de su familia.",
        "duracion" => 105,
        "director" => "Lee Unkrich",
        "reparto" => ["Anthony Gonzalez", "Gael García Bernal", "Benjamin Bratt"],
        "calificacion" => "Todos los públicos",
        "valoracion" => 5,
        "genero" => "Animación / Aventura",
        "trailer" => "https://www.youtube.com/embed/xlnPHQ3TLX8?si=uoK2aLfWi_Snidjy"
    ],
    [
        "id" => 11,
        "nombre" => "Gladiator",
        "imagen" => "https://image.tmdb.org/t/p/w500/ty8TGRuvJLPUmAR1H1nRIsgwvim.jpg",
        "horarios" => ["16:00", "19:00", "22:00"],
        "sinopsis" => "Un general romano traicionado busca justicia y venganza luchando como gladiador en la arena.",
        "duracion" => 155,
        "director" => "Ridley Scott",
        "reparto" => ["Russell Crowe", "Joaquin Phoenix", "Connie Nielsen"],
        "calificacion" => "+18",
        "valoracion" => 5,
        "genero" => "Acción / Drama histórico",
        "trailer" => "https://www.youtube.com/embed/owK1qxDselE?si=vu6C9JoY_9Y4jj8Z"
    ],
    [
        "id" => 12,
        "nombre" => "Spider-Man: No Way Home",
        "imagen" => "https://image.tmdb.org/t/p/w500/1g0dhYtq4irTY1GPXvft6k4YLjm.jpg",
        "horarios" => ["16:30", "19:30", "22:30"],
        "sinopsis" => "Peter Parker busca ayuda para recuperar su identidad secreta, pero un hechizo provoca consecuencias inesperadas.",
        "duracion" => 148,
        "director" => "Jon Watts",
        "reparto" => ["Tom Holland", "Zendaya", "Benedict Cumberbatch"],
        "calificacion" => "+12",
        "valoracion" => 4,
        "genero" => "Acción / Fantasía",
        "trailer" => "https://www.youtube.com/embed/JfVOs4VSpmA?si=pUHpB-mhoCz5_ul9"
    ]
];

function buscarPeliculaPorId($peliculas, $id) {
    foreach ($peliculas as $pelicula) {
        if ($pelicula["id"] == $id) {
            return $pelicula;
        }
    }

    return null;
}  

?>
