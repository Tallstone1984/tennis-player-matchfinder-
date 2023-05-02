<?php
     
    $dbc = mysqli_connect('localhost', 'root', '', 'tennisgroup');
    
    $create_table = "CREATE TABLE IF NOT EXISTS players (
    
    id INT NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(12),
    lastname VARCHAR(12),
    username VARCHAR(32),
    password VARCHAR(40),
    age INT(2),
    ranking FLOAT,
    mon tinyint(1),
    tue tinyint(1),
    wed tinyint(1),
    thu tinyint(1),
    fri tinyint(1),
    image VARCHAR(36) DEFAULT 'placeholder.jpg',
    PRIMARY KEY (id)
    )";

    mysqli_query($dbc, $create_table);

    $query = "INSERT INTO `players` (`id`, `firstname`, `lastname`, `username`, `password`, `age`, `ranking`, `mon`, `tue`, `wed`, `thu`, `fri`, `image`) VALUES

    (1, 'Andre', 'Agassi', 'agassi', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 55, 7, 0, 1, 0, 1, 0, 'andre.jpg'),
    (2, 'John', 'McEnroe', 'jmac', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 70, 6, 1, 0, 1, 0, 1, 'john.jpg'),
    (3, 'Pete', 'Sampras', 'pete', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 65, 6, 0, 0, 1, 1, 1, 'pete.jpg'),
    (4, 'Steffi', 'Graff', 'graff', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 55, 6, 1, 1, 1, 0, 0, 'steffi.jpg'),
    (5, 'Roger', 'Federer', 'roger', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 55, 7, 0, 0, 1, 1, 1, 'roger.jpg');";

    mysqli_query($dbc, $query);

    mysqli_close($dbc); // close database

    echo "<h1>TABLE CREATED!</h1>";

?>