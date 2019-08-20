<h1>Users</h1>
<div class="row col-md-12 centered">
    <table class="table table-striped custab">
        <thead>
        <a href="create" class="btn btn-primary btn-xs pull-right"><b>+</b> Add new task</a>
        <a href="delete" class="btn btn-primary btn-xs pull-right"><b>+</b> Delete a user</a>

        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Address</th>
            <th>Ville</th>
            <th>Email</th>
            <th>Zipcode</th>
            <th class="text-center">Action</th>
        </tr>
        </thead>
        <?php
        foreach ($users as $user)
        {
            echo '<tr>';
            echo "<td>" . $user['id'] . "</td>";
            echo "<td>" . $user['Nom'] . "</td>";
            echo "<td>" . $user['Prenom'] . "</td>";
            echo "<td>" . $user['Address'] . "</td>";
            echo "<td>" . $user['Ville'] . "</td>";
            echo "<td>" . $user['Email'] . "</td>";
            echo "<td>" . $user['Zipcode'] . "</td>";
            echo "<td class='text-center'><a class='btn btn-info btn-xs' href='edit" . $user["id"] . "' ><span class='glyphicon glyphicon-edit'></span> Edit</a> <a href='delete" . $user["id"] . "' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span> Del</a></td>";
            echo "</tr>";
        }
        ?>
    </table>