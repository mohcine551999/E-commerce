<?php 
include_once 'connexion.php';
$page = 'Home';
include_once './elements/header.php';

?>

<script>
home();
</script>
<div id="root" align="center">
</div>
<nav class="uk-navbar-container uk-margin-bottom" uk-navbar="mode: click">

        <div class="uk-navbar-center">
            <a class="uk-navbar-item uk-logo" href="/index.php"><img src="assets/img/logo.png" width="100px"/></a>
        </div>
        </nav>
<div align='center' id="ro" style="background-color: #f2f2f2;">
    <?php include_once "./controllers/products.php" ?>
    <h3>Bienvenue dans la boutique <span class="uk-badge"></span></h3>
    <hr class="uk-width-1-2@s"> 
  
    <ul style="display:inline" class="uk-pagination uk-margin" uk-margin>
        <li style="float: left;"><a href="index.php?page=<?=$pageCourante-1?>"><span uk-pagination-previous></span> Page Precedente</a></li>
        <li style="float: right;"><a href="index.php?page=<?=$pageCourante+1?>">Page Suivante<span uk-pagination-next></span> </a></li>
    </ul>
    <div align='left' id="divis" class="uk-grid-match uk-width-6-7 uk-child-width-1-2@s uk-child-width-1-5@l uk-text-center" uk-grid="parallax: 150">
        <?php if($checker>0){ while($a=$article->fetch()){ ?>
            <div>
                <div class=" uk-card uk-card-secondary">
                    <div class="uk-card-media-top uk-cover-container">
                        <img src="<?=$a['image']?>" width="200px" height="100px" alt="<?=$a['name']?>">
                    </div>
                    <div class="uk-card-body uk-card-hover">
                        <h5><?=$a['name'] ?></h5>
                        <small id="ar<?=$a['sku'] ?>"></small>
                    </div>
                    <div class="uk-card-footer"> 
                    <a class="uk-button uk-button-secondary" href="#modal-full<?=$a['sku']?>" uk-toggle><small>Add to cart</small></a>    
                    <br> <?=$a['price'] ?>$
                    </div>
                </div>
            </div>

            <div id="modal-full<?=$a['sku']?>" class="uk-modal-full" uk-modal>
                <div class="uk-modal-dialog">
                    <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
                    <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
                        <div class="uk-background-muted" style="background-image: url(<?=$a['image']?>);" uk-height-viewport></div>
                        <div class="uk-padding-large">
                            <h1><?=$a['name'] ?></h1>
                            <p><?=$a['description'] ?></p>
                            <form method="post">    
                            <div class="uk-width-2-3@s">
                                <input <?php if(!isset($_SESSION['id'])) echo 'disabled' ?> required class="uk-input" name="qte" type="number" placeholder="Quantity">
                            </div> 
                            <input required name="id" type="hidden" value="<?=$a['sku'] ?>">
                            <?php if(isset($_SESSION['id']) && !empty($_SESSION['id'])){?>
                            <button class="uk-button uk-button-secondary" type="submit">Add</button>
                            <?php }else{?>
                            <button class="uk-button uk-button-secondary" onclick="login();">Connectez-vous en premier</button>
                            <?php }?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php  }} ?>
    </div>
    <ul class="uk-pagination" uk-margin>
        <li><a href="index.php?page=<?=$pageCourante-1?>"><span uk-pagination-previous></span></a></li>
        <?php for($i=1;$i<=$pageTotal;$i++){
            if($i>7 && ($i%10!=0 || $i%20!=0)) echo '<li> </li>';else{?>
            
            <li><a href="index.php?page=<?=$i?>"><?=$i?></a></li>
        <?php } }?>
        <li><a href="index.php?page=<?=$pageCourante+1?>"><span uk-pagination-next></span></a></li>
    </ul>
</div>

<script src="./assets/js/scripts.js"></script>

<?php include_once './elements/footer.php';?>
