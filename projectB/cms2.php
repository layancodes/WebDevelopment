<?php

//counter function
function countFunc(){
    //go to file
    $counter = "counter.txt";
    //get file text info
    $oldcount = file_get_contents($counter);
    //add 1
    $oldcount++;
    //put info in folder
    file_put_contents($counter,$oldcount);
}

if (!isset($_GET['file'])){

    countFunc();


?>

<!DOCTYPE html>
<html>
<head>
<title>Assignment 2</title>

<link id="css-link" rel="stylesheet" href="Default.css">
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

/*---NAVIGATION BAR---*/

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
    height:96vh;
    overflow:scroll;
    
}


.buttons{
    padding:1em;
    display:block;
    width:18vw;
    background-color: black;
    font-family: Consolas, monaco, monospace;
    color: white;
}

#counter{
    padding-top: 0.2em;
    padding-left:0.3em; 
    

}
#number {
    display: inline;
}


/*---ERROR MESSAGE---*/ 
#errormessage{
    height:3vh;
    font-weight: bold;
    background-color: #FFFFFF;


}


/*END OF STYLE*/
</style>
</head>


<body onload="changePage('welcome.md')">
    

<table>
    
    <td id="nav">
        
            <ul>
                
                <li><button onclick="changePage('welcome.md')" class="buttons">Welcome!</button></li>
                <li><button onclick="changePage('sky.md')" class="buttons">Sky Colours</button></li>
                <li><button onclick="changePage('recipes.md')" class="buttons">Recipes</button></li>
                <li><button onclick="changePage('contact.md')" class="buttons">Contact</button></li>
                <li><button onclick="changePage('noaccess.md')"class="buttons">No access test</button></li>
                <li><button onclick="changePage('400file.md')"class="buttons">Invalid request test</button></li>
                <li><button onclick="changePage('bored.md')" class="buttons">Bored?</button></li>
               
                <li><button class="buttons" id="default" onclick="switchTheme('Default.css')">DARK</button></li>
                <li><button class="buttons" id="day" onclick="switchTheme('Day.css')">DAY</button></li>
                <li><button class="buttons" id="contrast" onclick="switchTheme('Contrast.css')">CONTRAST</button></li>

                <div id="counter">Visitor # 
                    <div id="number"> 
                        <?php echo file_get_contents('counter.txt'); ?>
                    </div>
                </div>
                    
            </ul>
        
    </td>

    <td >
        <div id="content">
        </div>
        <div id="errormessage">
                  
            
        </div>
        
    </td>
    
</table>
    


<script>

    function messageHandler(error, casenum){
        document.getElementById("errormessage").innerHTML = error;
        //cases
        switch (casenum){
            case 1: 
            errormessage.style.color = "green";
            break;
            case 2: 
            errormessage.style.color = "red";
            break;
            default:
                errormessage.style.color= "blue";
        }
    }

    function changePage(getpage){
        const url = "cms2.php?file=" + getpage 
        fetch(url)
        .then(responseHandler);
        messageHandler("Loading... please wait..");
       
        async function responseHandler(response){
            if(response.ok) {
                const html = await response.text();
                document.getElementById("content").innerHTML = html;
                messageHandler("Page loaded successfully", 1);
            } else {
                messageHandler("Error" + " "  + response.status + " " +  response.statusText, 2);
            }
    }
}

    
        
    function switchTheme(theme) {
        document.getElementById("css-link").href = theme;
        
        document.getElementById("errormessage").innerHTML = ("Theme is now " + theme.replace(/.css/,''));

    }

    </script>
<!--END OF SCRIPT-->
</body>
<!--END OF BODY-->
</html>
<!--END OF HTML-->

<?php


} else {


sleep(1.5);
$pages = array("welcome.md", "contact.md", "bored.md", "sky.md", "recipes.md", "noaccess.md");

//illegal file request 
if (!in_array($_GET['file'],$pages)){
    http_response_code(404);
    exit;
} 

//non-readable file
if (!is_readable($_GET['file'])) {
    http_response_code(503);
    exit;
}

require 'Parsedown.php'; 
$Parsedown = new Parsedown(); 
$Parsedown->setSafeMode(true);

echo $Parsedown->text(file_get_contents($_GET['file']));

}

?>
<!----------------END OF CODE---------------->