<?php 

   function get_CURL($url) {
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      $result = curl_exec($curl);
      curl_close($curl);

      return json_decode($result, true);
   }

   // channel
   $result = get_CURL('https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UCKII0Ml9S5wneKbHswmUrIQ&key=AIzaSyAR6_XQIx4NJ9uJyd9YsgCoO3L6B1PubEM');

   $youtubeProfilePic = $result['items'][0]['snippet']['thumbnails']['medium']['url'];
   $channelName = $result['items'][0]['snippet']['title'];
   $subscriber = $result['items'][0]['statistics']['subscriberCount'];
   $description = $result['items'][0]['snippet']['description'];


   // commentsThread
   $result = get_CURL('https://www.googleapis.com/youtube/v3/commentThreads?part=snippet&videoId=IhV8E0BJzUk&t=5s&maxResults=100&key=AIzaSyAR6_XQIx4NJ9uJyd9YsgCoO3L6B1PubEM');

   $totalResults = $result['pageInfo']['totalResults']
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <link rel="stylesheet" href="styles.css">
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <title>YouTube API</title>
</head>

<body>
   <div class="container">
      <div class="jumbotron mt-5 pt-4 pb-4 shadow p-3 mb-5 bg-white rounded">
         <h3 class="display-5 text-center title">YouTube API</h3>

         <hr class="my-4">
         <div class="row">
            <div class="col-md-6">
               <div class="row">
                  <div class="col-md-4 text-center">
                     <img src="<?= $youtubeProfilePic; ?>" class="rounded-circle img-thumbnail profilePic ">
                  </div>
                  <div class="col-md-8 channel mt-2">
                     <h5 class="namaChannel"><?= $channelName; ?></h5>
                     <p class="subs"><?= $subscriber; ?> Subscribers</p>
                     <div class="g-ytsubscribe" data-channel="GoogleDevelopers" data-layout="default"
                        data-count="default"></div>
                  </div>
               </div>
            </div>

            <div class="col-md-6">
          
            </div>
         </div>
   
         <div class="row mt-4">
            <div class="col">
               <h5 class="deskripsi">Deskripsi</h5>
               <p class="paragraph"><?= $description; ?></p>
            </div>
         </div>

         <div class="row mt-4">
            <div class="col">
               <h5 class="komentar">Komentar</h5>

               <?php  for($a = 0; $a <= $totalResults; $a++) {  ?>                
                  <div class="row mt-4">
                     <div class="col pl-4 col-img">
                        <img 
                           class="rounded-circle img-thumbnail" 
                           style="width: 50px" 
                           src="<?= $result['items'][$a]['snippet']['topLevelComment']['snippet']['authorProfileImageUrl']; ?>"
                        >
                     </div>
                     <div class="col col-comment">
                        <p class="mb-1 commentName">
                           <?= $result['items'][$a]['snippet']['topLevelComment']['snippet']['authorDisplayName']; ?>
                        </p>
                        <p class="comment">
                           <?= $result['items'][$a]['snippet']['topLevelComment']['snippet']['textDisplay']; ?>
                        </p>
                     </div>
                  </div>
               <?php  } ?>

            </div>
         </div>
      </div>
   </div>



   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" 
      integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" 
      crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
      integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
      crossorigin="anonymous"></script>
   <script src="https://apis.google.com/js/platform.js"></script>
</body>

</html>