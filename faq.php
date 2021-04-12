<?php
	session_start();
	
	$pageTitle='FAQ';
	include 'init.php';
	?>
	<!--Start FAQ intro-->
<section class="faq text-center" >
    <div class="container">
        <h1>Frequently Asked Question</h1>
        <hr>
        <p class="lead">Here You Will Find All Questions You Search For And The Full Knowledgebase</p>
    </div>
</section>
<!--Start FAQ Accordoin-->
<section class="faq-questions" >
    <div class="container">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php
        $stmt=$con->prepare("SELECT * FROM faqs");
                    $stmt->execute(array());
                    $faqs=$stmt->fetchAll();
    foreach ($faqs as $faq) {
      

              /* <!--start question 1 -->*/
         echo '<div class="panel panel-default">';
             echo "<div class='panel-heading' role='tab' id='heading-".$faq['Faq_ID']."'>";
               echo   '<h4 class="panel-title">';
                 echo   "<a role='button' data-toggle='collapse' data-parent='#accordion'
                     href='#collapse-".$faq['Faq_ID']."' aria-expanded='true' aria-controls='collapse-".$faq['Faq_ID']."'>";
                       echo" #".$faq['Faq_ID'].$faq['Question'] ;
                   echo '</a>';
                  echo'</h4>';
              echo'</div>';
               echo "<div id='collapse-".$faq['Faq_ID']."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='heading-".$faq['Faq_ID']."'>";
                 echo  "<div class='panel-body'>".$faq['Answer']."</div>";
               echo'</div>';
          echo '</div>';
          }       
        ?>          
        </div>
    </div>
</section>
	<?php
	include $tp1.'footer.php';
  ?>