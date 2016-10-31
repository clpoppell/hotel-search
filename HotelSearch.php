<html>
	<head>
		<meta charset="utf-8">
		<title>Hotel Search</title>
		<style>
			#top{
				width:700px;
			}
			#right{
				float:left;
				margin:10px;
			}
			#results{
				float:left;
				margin:10px;
				overflow:auto;
				height:85vh;
			}
		</style>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		
		<script type="text/javascript">
			$(document).ready(function(){
				<?php
					"session_start";
				
					$dbhost= 'localhost';
					$dbname= 'tripAdvisor';
					
					$m= new MongoClient();
					$db= $m->$dbname;
					$hotels= $db->hotels;
					
					if(isset($_POST["submit"])){
						$query= array();
						$name= $_POST["name"];
						$city= $_POST["city"];
						$class= $_POST["class"];
						
						if(strlen($name) > 0){ $query["name"]= new MongoRegex("/".$name."/i"); }
						if(strlen($city) > 0){ $query["address.locality"]= new MongoRegex("/".$city."/i"); }
						if(strlen($class) > 0){ $query["hotel_class"]= array('$gte' => floatVal($class)); }
						
						$items= $hotels->find($query);
						$items->sort(array('hotel_class' => -1, 'name' => 1));
							
						echo "$(\"#results\").html(\"";
							
						foreach($items as $item){
							if(array_key_exists("street-address", $item["address"])){ $address= $item["address"]["street-address"].", ".$item["address"]["locality"].", ".$item["address"]["region"]; }
							else{ $address= $item["address"]["locality"].", ".$item["address"]["region"]; }
							if(array_key_exists("hotel_class", $item)){ $class= "Rating:".$item["hotel_class"]." Stars<br>"; }
							else{ $class= ""; }
							
								
							echo "<p>";
							echo addslashes($item["name"])."<br>";
							echo $class;
							echo addslashes($address)."<br>";
							echo addslashes("<a href=\"".$item["url"]."\">Review</a>, ")."ID: ".$item["id"]."<br>";
							echo "</p>";
						}
						echo "\");";
						
						unset($_POST["name"]);
						unset($_POST["class"]);
						unset($_POST["city"]);
						unset($_POST["submit"]);
					}
				?>
			});
		</script>
	</head>
	<body>
		<div id="top">
			<h2 align="center"><u>Hotel Search Engine</u></h2>
		</div>
		<div id="right">
			<form method="post" id="search_form" action="HotelSearch.php">
				<p>
					City Name: <br><input type="text" id="city" name="city" size="50"/><br>
					Hotel Name: <br><input type="text" id="name" name="name" size="50"/><br>
					Rating: <br><input type="text" id="class" name="class" size="50"><br>
					<p><input type="submit" name="submit" value="Search"/></p><br>
				</p>
			</form>
		</div>
		<div id="results"><div>
	</body>
</html>