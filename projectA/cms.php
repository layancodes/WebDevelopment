<!DOCTYPE html>
<html>
<head>
<title>Assignment 1</title>

<link id="css-link" rel="stylesheet" href="default2.css">
<style> 

/*---GENERAL---*/

body{
    font-family: Consolas, monaco, monospace;
    margin: 0;
    height: 100%;
   
}

table{
    height:100vh;
}

td{
    height: 100%;
    vertical-align:top;
}
img{
    width:80vw;
    height:80vh;
  
  
}

/*---NAVIGATION---*/

ul {
    list-style-type: none;
    margin:0;
    padding:0 ;
    height: 100%;
}


li{
    font-size: 1.5em;
    padding:0.2em;  
}


#nav{
    width:20vw;
    height:99vh;
   
}

#content{
    width:80vw; 
    
}

div{
    height:99vh;
    overflow:scroll;
    
}

.buttons{
    padding:1em;
    display:block;
}



/*END OF STYLE*/
</style>
</head>


<body>

<table>
    
    <td id="nav">
        
            <ul>
                <li><a href=cms.php?>Welcome!</a></li>
                <li><a href=cms.php?page=1>Sky Colours</a></li>
                <li><a href=cms.php?page=2>Recipes</a></li>
                <li><a href=cms.php?page=3>Contact</a></li>
                <li><a href=cms.php?page=4>No access test</a></li>
                <li><a href=cms.php?page=5>Bored?</a></li>
                <button class="buttons" onclick="switchTheme('default2.css')">dark</button>
                <button class="buttons" onclick="switchTheme('day2.css')">day</button>
                <button class="buttons" onclick="switchTheme('contrast2.css')">contrast</button>
            </ul>
        
    </td>

    <td id="content">
        <div >

                <?php 
                
                #function for markdown display and with is_readable 
                function displayContent($path){
                    require 'Parsedown.php'; 
                    $Parsedown = new Parsedown(); 
                    $Parsedown->setSafeMode(true);

                    #checks  if file exists and is readable
                    
                    if (is_readable($path)){
                        echo $Parsedown->text(file_get_contents($path));
                    }
                    else {
                        echo "Error. File is not readable.";
                    }
                    
                    
                }
                
                #check if file is valid
                if (isset($_GET['page'])){
                    switch ($_GET['page']){

                        case 1:
                            displayContent("sky.md");
                            break;
                        case 2:
                            displayContent("recipes.md");
                            break;
                        case 3:
                            displayContent("contact.md");
                            break;
                        case 4:
                            displayContent("noaccess.md");
                            break;
                        case 5: 
                            displayContent("bored.md");
                            break;
                     
                            
                        #if parameter is invalid 
                        default:
                            echo "Invalid parameter. No such content!";
                        }
                }
                else {
                    #default page load 
                    displayContent("welcome.md");

                }
                
                ?> 
             
            </td>
        </div>
</table>
    


<script>
    function switchTheme(css) {
        document.getElementById("css-link").href = css;
    }
    </script>



<!--END OF BODY-->
</body>
</html>
<!--END OF CODE-->