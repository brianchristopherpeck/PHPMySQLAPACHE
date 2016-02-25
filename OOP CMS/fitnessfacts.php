<?php
	require_once('require.php');
    
	class factsMain extends Page {
		
		public $description = "Facts about fitness that will help you acheive your goal.";
		
		public $title = "Ripped and Fit: Fitness Facts Homepage";
		
		public function main(){
?>			<div id="main">
				<p><h1>Fitness Facts</h1></p>
				<p><h2>Calories In Versus Calories Out</h2></p>
				<p><h3>For Weight Loss:</h3><h4>The only way to lose weight is to burn more calories than you consume. Eat less, move more.</h4></p>
				<p><h3>For Weight Gain:</h3><h4>The only way to gain weight is eat more calories than you burn. Eat more, move less. If you want to gain 
				</h4></p>
				<p><h2>The Myth of How Cardio Makes Your Body Look</h2></p>
				<p><h4>Cardio will shrink your body. It's an excellent way to burn massive amounts of calories at a time. The great
				myth about that cardio is that it will make your body look toned. It will shrink your body, but that's it. The look
				that your body gets from lots of cardio is based more on genetics. The way around this is to add weight
				lifting and muscle toning excercises into your workout routine. YOU MUST LIFT WEIGHTS OR DO WEIGHT-BEARING EXCERCISES
				TO SCULPT YOUR BODY (this can include excercises that require body weight, i.e. pushups or pullups.)</h4></p>
				<p><h2>The Advantages of Core Training</h2></p>
				<p><h4>First off, core training is NOT the same thing as ab excercise, even though your abs are part of your core.
				Core training makes the support structure of your body function more efficiently. High core centered
				fitness routines such as pilates and yoga will increase balance, strength and explosivity. It will also 
				help to tone your body and improve your look. Adding core training to your routine is essential to retaining 
				joint health and mobility. Most core training deals with either stabilization or movements that occur in the
				transverse plane of motion, which is the range of motion that most injuries occur.</h4></p>
				<p><h2>Hypertrophy</h2></p>
				<p><h4>Hypertrophy as it relates to fitness, is the excessive accumulation of muscle mass in a specific
				area of the body. To cause hypertrophy one must exert muscle tissue to the point where it breaks down
				from the stress of the physical activity. If doing an excercise to cause hypertrophy of a muscle, 6-8 reps
				is adequate and by the eighth repetition, the muscle should be attempting to fail. This is integral in body
				sculpting and weight gaining.</h4></p>
			</div>
<?php
		}
	}
	
	$fitnessfacts = new factsMain;
	$fitnessfacts->Display();
	
	
?>
