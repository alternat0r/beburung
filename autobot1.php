<?php
	/*
		beburung v0.1a
		by alternat0r
		created on some date in 2013
	*/

	require_once "config.php";
	require_once('twitteroauth-master/twitteroauth/twitteroauth.php');
	require_once('SimplePie.mini.php');
	
	// your rss array list
	$news_array = array(
		1 => "http://www.data0.net/feeds/posts/default?alt=rss" // example from Data0.net
	);
	
	$news_hash_array = array(
		1 => "alternat0r" // hashtag for the array 1 news
	);
	
	$max_arr_size = sizeof($news_array);

	for($a=1; $a<$max_arr_size+1; $a++) {

		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
		$feed = new SimplePie();
		$feed->set_feed_url($news_array[$a]);
		$feed->init();
		$feed->handle_content_type();

		/* find the total number of available feed */
		$max = $feed->get_item_quantity();
		 
		/* Get last tweeted data */
		if (is_dir(getcwd()."/cache")) {
			$last_saved_tweet = file_get_contents(getcwd().'/cache/last_tweet'.$a);
		} else {
			mkdir(getcwd()."/cache");
			$last_saved_tweet = file_get_contents(getcwd().'/cache/last_tweet'.$a);
		}
		
		$item = new SimplePie();
		/* Get the first item on the feed */
		$item = $feed->get_item(0);
		 
		/* permalink of the first item */
		if(!is_null($item)) {
			$itemlink = $item->get_permalink();
			 
			/* save the permalink into file */
			file_put_contents(getcwd().'/cache/last_tweet'.$a, $itemlink);

			 
			/* title of the first item */
			$itemtitle = $item->get_title();
			
			/* length of the item title */
			$titlelength = strlen($itemtitle);
			 
			if ($titlelength > 110) {
				$itemtitle = substr($itemtitle, 0, 107) . "...";
			}
			 
			if ($itemlink != $last_saved_tweet) {

				/* shorten the url with ly.my */
				if ($stream = fopen("http://ly.my/api.php?url=" . $itemlink, 'r')) {
					$shortlink = stream_get_contents($stream);
					//$shortlink = substr($shortlink,0,strrpos($shortlink,'<!--'));
					fclose($stream);
				}
		
				/* if any of this string match the title it will become append a hash tag. Change the hash keyword accordingly. */
				$hash_string = array(
					1 => "Jenayah",		2 => "Cyber",			3 => "crime",
					4 => "pencuri",			5 => "berjaya",			6 => "FBI",
					7 => "CIA",				8 => "Interpol", 		9 => "PATI",
					10 => "pendatang",	11 => "syria",			12 => "terbaru",
					13 => "MCA",			14 => "UNMO", 			15 => "PAS",
					16 => "DAP",			17 => "hiburan",		18 => "NGO",
					19 => "BR1M",			20 => "PRK",				21 => "kencang",
					22 => "Chelsea",		23 => "Ops",				24 => "Presiden",
					25 => "Artis",			26 => "Anwar",			27 => "politik",
					28 => "tv1",				29 => "tv2",				30 => "tv3",
					31 => "tv9",				32 => "alhijrah",		33 => "malaysia",
					34 => "melayu",		35 => "malaysian",	36 => "skandal",
					37 => "dunia",			38 => "polis",			39 => "pdrm",
					40 => "pekida",			41 => "maksiat",		42 => "arsenal",
					43 => "Banjir",			44 => "Amuk",			45 => "gajah",
					46 => "BN",				47 => "EPL",				48 => "JPJ",
					49 => "Mati",				50 => "Lemas",			51 => "Sarawak",
					52 => "Selangor",		53 => "ASEAN",			54 => "KWSP",
					55 => "Najib",			56 => "CyberSecurity",	57 => "Gangnam",
					58 => "MH370"
				);

				$max_hash_string = sizeof($hash_string);
				for($t=1; $t<$max_hash_string+1; $t++) {
					if(strlen(stristr($itemtitle, $hash_string[$t]))>0) {
						$put_hash = "#".$hash_string[$t];
					} else {
						$put_hash = "";
					}
				}
			 
				/* Update status with Abraham's oAuth Library */
				if(isset($put_hash)) {
					$connection->post('statuses/update', array ('status' => $itemtitle . " " . $shortlink." ".$put_hash." #".$news_hash_array[$a]));
					echo colorize("[+][".$a."] NEW @".TWITTER_USERNAME.": ".$itemtitle." ".$shortlink." ".$put_hash." #".$news_hash_array[$a]."\n", "GREEN");
				} else {
					$connection->post('statuses/update', array ('status' => $itemtitle . " " . $shortlink." #".$news_hash_array[$a]));
					echo colorize("[+][".$a."] NEW @".TWITTER_USERNAME.": ".$itemtitle." ".$shortlink." #".$news_hash_array[$a]."\n", "YELLOW");
				}
			} else {
				echo "[-][".$a."] Already @".TWITTER_USERNAME.": ".$last_saved_tweet."\n";
			}
		} else {
			echo colorize("[-][".$a."] ERROR!\n", "RED");
		}
	}
	
	function colorize($text, $status) {
		$out = "";
		switch($status) {
			case "GREEN":
				$out = "[32m"; //Green background
				break;
			case "RED":
				$out = "[31m"; //Red background
				break;
			case "YELLOW":
				$out = "[33m"; //Yellow background
				break;
			case "BLUE":
				$out = "[36m"; //Blue background
				break;
			default:
			throw new Exception("Invalid status: " . $status);
		}
		return chr(27) . "$out" . "$text" . chr(27) . "[0m";
	}
?>
