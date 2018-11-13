<?php
    require_once('../../core/init.php');
    Session::isLoggedIn();
    $obj = new Event();
    $gallerys = $obj->getEventGallery();

    require_once(ROOT . 'user/includes/header.php');
    require_once(ROOT . 'user/includes/navbar.php');
?>

<section id="main">
    <section class="container">
        <!-- page start-->
        <div class="row">
            <?php require_once(ROOT . 'user/includes/sidebar.php');?>
            <aside class="profile-info col-lg-9">
                <?php echo sessionDisplayMessage(); ?>
                <section class="panel">
                    <header class="panel-heading">
                        Event Gallery
                    </header>
                    <div class="panel-body">
                        <div class="row">
                        <?php foreach($gallerys as $gallery) { ?>
                            <div class="col-md-4">
                              <div class="gallery">
                                <img src="<?= ASSET . checkImage($gallery->image, 'event'); ?>" alt="Avatar" class="image thumbnail">
                                <div class="overlay">
                                  <div class="text-center text">
                                    <p><?= $gallery->caption ?></p>
                                    <a href="<?= URL .'user/event/edit_event_gallery.php?id='.Secure::encrypt($gallery->id)?>">Edit</a>
                                    <a href="" class="delete" data-id="<?php echo Secure::encrypt($gallery->id)?>" data-target=".modal" data-toggle="modal" data-url="<?= URL . 'user/event/delete_event_gallery.php?id='. Secure::encrypt($gallery->id) ?>">Delete</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <?php } ?> 
                        </div>

                        <!-- <div class="grid cs-style-3">
                            <div class="col-lg-4">
                                <img src="<?= ASSET. checkImage($gallery->image, 'event') ?>">
                            </div> 
                            <ul>
                                <?php foreach($gallerys as $gallery) { ?> 
                                <li>
                                    <figure>
                                        <img src="<?= ASSET. checkImage($gallery->image, 'event') ?>">
                                    </figure>   
                                </li>
                                <?php }?>
                            </ul>
                        </div> -->
                    </div>
                </section>
            </aside>    
        </div>
    </section>
</section>

<div class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Delete Event</h4>
            </div>
            <div class="modal-body">
                <p>Are You sure you want to delete the event?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="" class="btn btn-primary del">Delete</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    $('.delete').click(function(){
        var id = $(this).data('id');
        var url = $(this).data('url');
        $('.modal').on('show.bs.modal', function (e) {
            $('.del').attr('href', url);
        });
    });
</script>
<?php
    require_once(ROOT . 'user/includes/footer.php');
?>