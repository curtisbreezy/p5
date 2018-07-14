<?php  session_start();

$bdd = new PDO("mysql:host=localhost;dbname=projet_5;charset=utf8", "root", "");

$comments = $bdd->query('SELECT * FROM commentaire WHERE validate = 1  ORDER BY commentairedate ASC LIMIT 0, 10');

if(isset($_GET['id']) AND !empty($_GET['id'])) {
    
	$get_id = htmlentities($_GET['id']);
	
	$article = $bdd->prepare('SELECT * FROM articles WHERE id_article = ?');
	$article->execute(array($get_id));
	
	if($article->rowCount()== 1) {
		$article = $article->fetch();
		$titre = $article['titrepost'];
		$contenu = $article['textepost'];
		$articles = $bdd->query('SELECT * FROM articles WHERE id_article = '.$get_id.' ORDER BY id_article DESC LIMIT 0, 10');
}

}



?>

<!DOCTYPE html>
<html lang="fr">
s

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mourad-Kheloui Développeur PHP</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Custom styles for this template -->
   <link href="css/articles.css" rel="stylesheet">
	
	

  </head>

  <body id="page-top">

    <!-- Navigation -->
      <nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top" id="mainNav">
          <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="index.php">Accueil</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="login.php">Connexion/Inscription</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="index.php#about">A propos</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="index.php#services">Mes compétences</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="index.php#portfolio">Mon Portfolio</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="index.php/#contact">Contact</a>
                </li>
              </ul>
            </div>
          </div>
          
      </nav>
	 
	   
   
  
					<!--DÉBUT CODE À RÉVISER-->

<section> 
	<div class="text-center">
		 <div class="mb-3">
				<div class="caption m-3">
                    
					
                        
                        <script src="vendor/jquery/jquery.min.js"></script>
                        
                        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
                        
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

                        <script>
                            
                            $( document ).ready(function() {
                                $( ".commentbutton" ).click(function() {
                                    
                                    $(".comments" + event.target.id).toggle();
                                    
                                });
                                
                                $( ".seecommentbutton" ).click(function() {
                                    
                                    $('.savebutton').attr('id',event.target.id); 
                                    
                                });
								
								
								$( ".seecommentbutton2" ).click(function() {
                                    
                                    $('.savebutton2').attr('id',event.target.id); 
                                    
                                });
                                <!--premier modal-->
                                $( ".savebutton" ).click(function() {
                                                        
                                    var author = $("#exampleInputAuthor1").val();
                                    var comment = $("#exampleInputComment1").val();
                                    
                                     $.ajax({
                                        type: 'POST',
                                        url: "addcomment.php",
                                        cache: false,
                                        data: { id : event.target.id, author: author, comment: comment },
                                        success: function(data){  
                                            alert(data);
                                        }
                                    });
                                    
                                });
								
								<!-- second modal -->
								
								$( ".savebutton2" ).click(function() {
                                                        
                                    var author = $("pseudo").val();
                                    var comment = $("reponse").val();
                                    
                                     $.ajax({
                                        type: 'POST',
                                        url: "answer.php",
                                        cache: false,
                                        data: { id : event.target.id, author: author, comment: comment },
                                        success: function(data){  
                                            alert(data);
                                        }
                                    });
                                    
                                });
								
                            });
                        </script>
						
<div class="container">
		<font face="Century Gothic" size="20"> Articles </font>
                      
				
				        <!-- récupération des articles en base de donnée -->
                        <?php while($a = $articles->fetch()) {  
                        
                            $current = $a['id_article'] ?>

                            <div id="currentarticle" class="p-3" style="margin-bottom:50px;">
								
                             
                                <h4 style="font-weight:bold;"><?=$a['titrepost'] ?></h4>
								<hr/>								

                                <p><?=$a['textepost'] ?></p>
								<hr/>

                                <p style="color:lightgray;">Rédigé par <?=$a['auteurpost'] ?>, le <?=$a['datepost'] ?>. </p> 

                                <br/>

                                <button id="<?php echo $a['id_article']; ?>" class="commentbutton btn btn-primary" >Voir les commentaires</button>
                                
                                <button id="<?php echo $a['id_article']; ?>" class="seecommentbutton btn btn-success"  data-toggle="modal" data-target="#myModalNorm">Poster un commentaire</button>
								
								
                            
								
								
								
									
								
								
								
								
                            </div>
                            
                            
                           <!-- Récupération des commentaires liés à l'article -->
                            <div class="comments<?php echo $a['id_article']; ?>" style="margin-bottom:100px; margin-left:75px; display:none;">
									
									
                                <?php
                                   
									$comments = $bdd->query('SELECT * FROM commentaire WHERE parent_id = 0 AND validate = 1 AND id_article = ' . $current . '  ORDER BY commentairedate ASC LIMIT 0, 10');
							
                                ?>
                                <?php while($c = $comments->fetch()) { 
								 $answer = $c['id_commentaire'] ;
								?> 
								

                                    <div style="margin-top:5%;margin-bottom:5%; border:1px solid lightgray; padding: 10px;">
                                        <p><?=$c['commentairetexte'] ?></p>

                                        <p style="color:lightgray;">Rédigé par <?=$c['pseudo'] ?>, le <?=$c['commentairedate'] ?>. </p>

											<a type="submit"class="btn btn-danger" href="supprimercomm.php?id=<?= $c['id_commentaire'] ?>"> Supprimer le commentaire </a> 
											
											<br/>
											
											<a type="submit" name="repondre" href="answer.php?id_commentaire=<?=$c['id_commentaire']?>&id_article=<?=$a['id_article']?>&validate=<?=$c['validate']?>" class="btn btn-success"> Répondre au commentaire </a>
											
											
											
											<?php while($c = $comments->fetch()) { 
								
											$comments = $bdd->query('SELECT * FROM commentaire WHERE  validate = 1 AND id_article = ' . $current . '  ORDER BY commentairedate ASC LIMIT 0, 10');	 
									
											?>	
								
											
                                        <p> Réponse : <?=$c['commentairetexte'] ?></p>
											<hr/>
												<?=$c['commentairedate'] ?>
											
									
								
								
									
									
											
                           
								<?php } ?> 
							</div>	 
							<?php } ?>	
				  
				  </div>
				  <?php } ?> 
	 </div>
				 
</div>
                    
											



				<!-- Modal -->
                    <div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog" 
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">
                                        Ajouter un commentaire
                                    </h4>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">

                                    <form role="form">
                                      <div class="form-group">
                                        <label for="exampleInputAuthor1">Auteur</label>
                                          <input type="text" class="form-control"
                                          id="exampleInputAuthor1" placeholder="Auteur"/>
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputComment1">Commentaire</label>
                                          <input type="text" class="form-control"
                                              id="exampleInputComment1" placeholder="Commentaire"/>
                                      </div>
                                    
                                      <button id="savebutton" type="submit" class="btn btn-secondary savebutton" style="float:right;">Enregistrer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--END OF Modal-->
							
	
            </div>
        </div>
    </div>
</section>

<!--FIN CODE À RÉVISER-->
<!--VOIR AUSSI addcomment.php-->

        </div>
       
    </header>	

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/creative.min.js"></script>
	
	
  </body>
</html>