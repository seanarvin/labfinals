
<datalist id="work">
    <?php
    $sql = "SELECT * FROM work";
    $res = $conn->query($sql);

    while ($row = $res->fetch_assoc()){
        echo "<option>" . $row['description'] . "</option>";
    }
    ?>
</datalist>
<input list="work" class="form-control" name="category" type="email" multiple>