<! Doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title> PHP Select Dropdown Example </title>
        <!-- <style>
            .container {
                max-width: 400px;
                margin: 60px auto;
                text-align: center;
            }

            input[type="submit"] {
                margin-bottom: 25px;
            }

            .select-block {
                width: 350px;
                margin: 100px auto 40px;
                position: relative;
            }

            select {
                width: 100%;
                height: 50px;
                font-size: 100%;
                font-weight: bold;
                cursor: pointer;
                border-radius: 0;
                background-color: #1A33FF;
                border: none;
                border: 2px solid #1A33FF;
                border-radius: 4px;
                color: white;
                appearance: none;
                padding: 8px 38px 10px 18px;
                -webkit-appearance: none;
                -moz-appearance: none;
                transition: color 0.3s ease, background-color 0.3s ease, border-bottom-color 0.3s ease;
            }

            select::-ms-expand {
                display: none;
            }

            .selectIcon {
                top: 7px;
                right: 15px;
                width: 30px;
                height: 36px;
                padding-left: 5px;
                pointer-events: none;
                position: absolute;
                transition: background-color 0.3s ease, border-color 0.3s ease;
            }

            .selectIcon svg.icon {
                transition: fill 0.3s ease;
                fill: white;
            }

            select:hover {
                color: #000000;
                background-color: white;
            }

            select:focus {
                color: #000000;
                background-color: white;
            }

            select:hover~.selectIcon {
                background-color: white;
            }

            select:focus~.selectIcon {
                background-color: white;
            }

            select:hover~.selectIcon svg.icon {
                fill: #1A33FF;
            }

            select:focus~.selectIcon svg.icon {
                fill: #1A33FF;
            }

            h2 {
                font-style: italic;
                font-family: "Playfair Display", "Bookman", serif;
                color: #999;
                letter-spacing: -0.005em;
                word-spacing: 1px;
                font-size: 1.75em;
                font-weight: bold;
            }

            h1 {
                font-style: italic;
                font-family: "Playfair Display", "Bookman", serif;
                color: #999;
                letter-spacing: -0.005em;
                word-spacing: 1px;
                font-size: 2.75em;
                font-weight: bold;
            }

            input[type=submit] {
                border: 3px solid;
                border-radius: 2px;
                color: ;
                display: block;
                font-size: 1em;
                font-weight: bold;
                margin: 1em auto;
                padding: 1em 4em;
                position: relative;
                text-transform: uppercase;
            }

            input[type=submit]::before,
            input[type=submit]::after {
                background: #fff;
                content: '';
                position: absolute;
                z-index: -1;
            }

            input[type=submit]:hover {
                color: #1A33FF;
            }
        </style> -->
    </head>

    <body>
        <div class="container mt-5">
            <form action="" method="post">
                <select name="Movies">
                    <option> Select option </option>
                    <option> Harry Potter </option>
                    <option> Bonnie and Clyde </option>
                    <option> Reservoir Dogs </option>
                    <option> Don </option>
                    <option> Anaconda </option>
                </select>
                <br> <br> <input type="submit" name="submit">
            </form>
            <?php
            if (isset($_POST['submit'])) {
                if (!empty($_POST['Movies'])) {
                    $selected = $_POST['Movies'];
                    echo 'You have chosen: ' . $selected;
                } else {
                    echo 'Please select the value.';
                }
            }
            ?>
        </div>
    </body>

    </html>