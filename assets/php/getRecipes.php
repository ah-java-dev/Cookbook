<?php
    $connection = new mysqli("localhost", "root", "", "recipes");

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $title = $_POST['title'];
    $sql = "";

    if (strcmp($title, "") == 0) {
        $sql = "SELECT * FROM `przepisy`";
    } else {
        $sql = "SELECT * FROM `przepisy` WHERE `title` LIKE '%{$title}%'";
    }

    $query = $connection->query($sql);

    if ($query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
            $card_title = ucfirst($row['title']);

            echo <<< END
                <div class="col" style="padding: 0;margin: 12px;width: 300px;">
                    <div class="card border-0" style="border-color: var(--bs-dark);background: var(--bs-dark);">
                        <img class="rounded card-img-top w-100 d-block border border-2 border-dark card-img-top" style="height: 180px;background: transparent;" src="{$row['image']}" alt="Image" loading="eager" width="300px" height="180px">
                        <div class="card-body border rounded border-2 border-dark" style="height: 100px;padding: 8px;margin-top: -2px;background: var(--bs-body-bg);">
                            <h4 class="card-title" style="font-size: 18px;margin-bottom: 4px;height: 100%;">{$card_title}</h4>
                        </div>
                    </div>
                </div>
            END;
        }
    } else {
        echo <<< END
            <div class="col text-center" style="padding: 8px;margin-top: 80px;width: 100%;">
                <h4 style="font-size: 18px;height: 100%;">The recipe you are looking for is not yet in our database, but you can add it at your leisure in the create tab :)</h4>
            </div>
        END;
    }

    $connection->close();
