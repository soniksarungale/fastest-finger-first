<?php
    session_start();
    if(isset($_SESSION["id"]) && isset($_SESSION["uname"]) && isset($_SESSION["level"])){
        if($_SESSION["level"]=="display"){            
    ?>
        
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width">
            <title>Display</title>
            <link href="display.css" rel="stylesheet" type="text/css">
        </head>
        <body>
          <div class="layer l0">
              <button class="next-btn" onclick="l0()">Next</button> 
           </div>
           <div class="layer l1">
               <div class="question">
                   Starting with the biggest, arrange these astronomical bodies of the Solar System in decreasing order of their size
               </div>
              <button class="next-btn" onclick="l1()">Next</button> 
           </div>
           <div class="layer l2">
               <div class="kbm-logo">
                   <div class="kbm-img">
                       <img src="kbm.png" alt="KBM IMAGE">
                   </div>
               </div>
               <div class="kdm">
                   <div class="container">
                       <div class="correct-heading"><span>Correct Squence</span></div>
                       <div class="correct">
                           <div class="ans" id="a1">C) Delhi</div>
                           <div class="ans" id="a2">B) Kolkatta</div>
                           <div class="ans" id="a3">D) Chennai</div>
                           <div class="ans" id="a4">A) Mumbai</div>
                       </div>
                   </div>
               </div>
               <button class="next-btn" onclick="l2()">Next</button> 
           </div>
           <script src="../../jquery.js"></script>  
           <script>
               function l0(){
                  $(".l0").css("display","none");
                $(".l1").fadeIn("slow"); 
               }
            function l1(){
                $(".l1").css("display","none");
                $(".l2").fadeIn("slow");
            } 
               var current=1;
               function l2(){
                   switch(current){
                       case 1:
                           $("#a1").css("opacity","1");
                           current++;
                       break;
                       case 2:
                           $("#a2").css("opacity","1");
                           current++;
                       break;
                        case 3:
                           $("#a3").css("opacity","1");
                           current++;
                       break;
                       case 4:
                           $("#a4").css("opacity","1");
                           current++;
                       break;
                       case 5:
                           window.location = "dispans.php";                           
                       break;
                    }
               }
            </script>
        </body>
        </html>
        
        
        <?php  
            }
    }
    else{
        header("Location: ../index.php");
    }
?>