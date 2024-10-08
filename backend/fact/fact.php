    <?php
    include '../extends/header.php';

    $fact_query = 'SELECT * FROM facts' ;
    $facts= mysqli_query($db,$fact_query);

    ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-end">
                    <h4>Services</h4>
                    <a href="./fact-create.php"type="button" class="btn btn-primary"><i class="material-icons">add</i>Create</a>   
                    </div>
            <div class="card-body">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Icon</th>
                            <th scope="col">titel</th>
                            <th scope="col">Descryption</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                            </tr>
                    </thead>
                 <tbody>


                    <?php 
                    $num =1;
                    foreach($facts as $fact) :
                     ?>
                        <tr>
                            <th scope="row"><?= $num++ ?></th>
                                <td class="<?= $fact['icon']?> fa-2x"> </td>
                                <td><?= $fact['titel']?></td>
                                <td><?= $fact['description']?></td>
                                <td>
                                    <a href="./fact-store.php?statusid=<?= $fact['id']?>" class=" 
                                    <?= ($fact['status'] == 'deactive') ? 'badge bg-danger' :'badge bg-success' ?> text-white"><?= 
                                    $fact['status']?></a>
                                </td> 
                                <td>
                                <div class="d-flex justify-content-around align-items-center"> 
                                    <a href="fact-edit.php?editid=<?= $fact['id'] ?>" class="text-primary fa-2x">
                                        <i class="fa fa-chain"></i>
                                    </a>

                                     <a href="fact-store.php?deleteid=<?=$fact['id']?>" class="text-danger fa-2x"><i class="fa fa-trash"></i></a>
                                </td>
                                </tr>
                                <?php endforeach ;?>
                    </tbody>
                </table>
                    </div>
                </div>
            </div>
        </div>

    <?php
    include '../extends/footer.php'
    ?>