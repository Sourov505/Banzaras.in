-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 20, 2017 at 01:41 PM
-- Server version: 5.6.29-76.2-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zenexxg6_banzarasin_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `authorId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  PRIMARY KEY (`authorId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`authorId`, `name`, `email`, `bio`, `facebook`, `twitter`, `instagram`) VALUES
(1, 'Madhurima Pramanik', 'banzaras.in@gmail.com ', 'I am a software engineer by profession and a banzara by heart. I don''t remember when exactly I got infected by wanderslust but it''s been 3 years I have been diagnosed. To escape from my routined life, I go on trips pretty often. I will be freaked out if I can''t go anywhere once in two months. I have a thing for the less explored, not-so-famous places. Don''t go by the names, sometimes a place you have never heard of before, can give you a lifetime experience. Take the risk, get out of your comfort zone, feel the adrenaline rush. I am here to share my stories and you can find some really helpful information. Hope you guys like it! Contact me at banzaras.in@gmail.com or find me on Facebook or Instagram.', 'https://www.facebook.com/madhurima.pramanik', '#banzaras.in', 'https://www.instagram.com/madhurimapramanik18/');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `blogId` int(11) NOT NULL,
  `authorId` int(11) NOT NULL,
  `detailId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `tags` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `isVisible` tinyint(1) NOT NULL DEFAULT '0',
  `images` varchar(255) NOT NULL,
  PRIMARY KEY (`blogId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blogId`, `authorId`, `detailId`, `categoryId`, `title`, `body`, `tags`, `date`, `isActive`, `isVisible`, `images`) VALUES
(1001, 1, 1, 0, 'Baranti - A small Hamlet in Purulia', 'If you are looking for a place to just relax and refresh your mind far from the crowds then it’s the perfect place for you. Baranti is a small village surrounded with greenery, hills and a big natural lake.\nWe boarded the Chakradharpur Passenger from Howrah on a Thursday night. Next morning around 5.30 am we reached Adra. Car was waiting for us at station and before 7.30 we reached Lake Hill Resort. Don’t go by the name, it’s nothing like a resort. There were only three rooms with basic facilities. No AC, no power backup but the view paid off everything.\nIt was raining and the place was so peaceful that we could hear the sound of rain. Caretaker Birbal was very efficient and he soon served us with a delicious breakfast – luchi, aloor dom. We spent the day at leisure appreciating the beauty of the place. There was nothing nearby not a single shop, so it’s better to carry everything you need. We went for a walk in the afternoon, enjoyed the breathtaking sunset. But due to rain we had to get back soon. It was raining heavily and lightning almost struck the lake water. It was terrific! The food was tasty but you will get only Bengali food. Fooding charge is Rs.300 per day (Morning bed tea to dinner).\nOne can hire a car and visit the nearby attractions like Biharinath, Garpanchkot, Maithon Dam, Ayodhya Pahar, Kashipur Rajbari, Joychondi Pahar. Though we preferred to sit and relax. You may consider us lazy but we just wanted an escape from our busy life. We walked along the red mud road with the lake at our side upto Baranti Hill, climbed a bit, clicked few pics and returned back.\nIt was our last day and our train was at 4.24 pm from Adra. We booked a car and went to Garpanchkot and Joychondi Pahar on our way back to Adra. The car took 1000 bucks. Garpanchkot was nice but you shouldn’t miss Joychondi Pahar. It offers a great view of the surroundings. We spent some time there. We headed back to Kolkata by Rupasibangla Express and our beautiful journey ended with a satisfactory smile.\nHow to reach:\nBy Train: From Howrah go to Adra or Asansol. Take a local train to reach Muradi (Journey time approx.. 30 mins). It’s on the Adra-Asansol line. From Muradi you can take trekker, riskshaw or a hired taxi to reach Baranti. You can also book direct car from Adra.\nBy Car:\nKolkata > Dankuni - NH 2 > Asansol - leave NH 2 and take the old GT Road through Asansol city, just before entering Asansol > Neamatpur – turn left > Disergarh Bridge across the Damodar River > Sarbori Morh on Barakarar Purulia Road > Subhas Morh – turn left > Kotaldih village > Ramchandrapur village > Muradi village > Baranti  (263 kms)\nOne can also take -\nRaniganj Punjabi More > turn left > Before Raniguanj Station turn right > Mejia More > Cross Mejia Bridge > Turn right for Saltora > Just cross Santuri Police Station – turn right > Baranti (237 kms)\n\n\n\nPlaces to Stay:\nLake Hill Resort (Nearest to the Lake)\nContact Person: P. K. Ghosh , Mobile No: 9432296178 / 7059970618 ,   E-mail : pulak@lakehillresort.in , pulak3398@gmail.com , Website: lakehillresort.in , Room rent: Rs 800 per day\nAkashmoni Resort (Just behind Lake Hill Resort)\nContact Person: Jolly Das in Salt Lake Kolkata , Mobile No: +91 8017215958 , Website: www.akaashmoni.in , Standard Cottages: Rs 850 per day , Deluxe Cottages: Rs 1200 per day\nAnkhaibari Village Resort (Better option)\nMobile: +91-9051267310 /+91-9609811544 /+91-9800420013 , Website: barantiankhairesort.com\nWe were not aware of this place. It’s beside Lake Hill Resort. We peeked in and it looked good.\nThere are many other options available but these are closer to the lake.\nWhen to Visit:\nYou can visit it at any time of the year. During rainy season the lash green will soothe your eye. And I am sure it looks spectacular in Autumn with Palash in full bloom.\nTips:\n1.Carry Mosquito repellent cream and basic medicines.\n2.If you want to have alcohol it’s better to carry your drinks.\n\n', 'West Bengal, Kolkata', '2017-05-08', 1, 1, '13,11,12,14,15,50'),
(1002, 1, 1, 0, 'Singell Tea Estate - Kurseong', 'Heart was crying for hills but time was not permitting a long trip. So we chose Kurseong for a small escape, to soothe our eyes, to get a touch of hills.\nMe and my friends headed for Siliguri on a Friday evening. And we reached Singell next afternoon. Singell is a lesser known destination close to both Kurseong and Darjeeling surrounded by Alpine trees and tea estate. The lavish green surroundings will be a relief to your eye. The Singell Homestay is built in a cliff at 2 minutes distance from the main road. It’s managed by two wonderful hosts – Lathika and Aruna. We were given two rooms in the ground floor and one on the top floor though the entry of the house is on the top floor. The room on the top floor was best with an attached balcony and we spent most of the time there. Singell Tea Estate, Winding roads, Toy-train track overall a picturesque village. After lunch, we went out to explore the area, hiked through tea gardens, clicked hundreds of pics, watched sunset. You can also visit Eagle’s Craig View Point, Dowhill etc. Though we spent the afternoon doing absolutely crazy things amidst nature and this is actually what I need to survive. We were served with tea and snacks in the evening and on request they prepared tasty pakoras. The evening just went by with lots of fun and laughter. \nNext morning we woke up to a cloudy atmosphere. It was a one day trip only and we had to leave. The yummy breakfast of parathas with chana and omelette was a perfect start for the day. After breakfast, we spent few hours in the terrace and it started raining. Fortunately the rain stopped soon. We had plenty of time left as our bus was at 7pm in the evening from Siliguri. We started walking through the toy-train track, clicked few selfies on the way. We stopped at a place to have tea. It was basically a parking-lot but the roof of that place offers a great view. We decided to spend some time there. We needed a car to reach Siliguri and the in-charge of that parking-lot was more worried than us. He arranged a car for us at the cost of 100Rs per head. We negotiated with the driver and at the cost of 1000Rs all total he agreed to stop somewhere nice. He really made our halt worthy enough. Whenever I visualize that place in my mind’s eye, a variety of green colour flashes in-front of me. We left the place with a heavy heart.\nHow to reach:\nNearest Railway Station is New Jalpaiguri. You can rent a car for Singell from NJP. It is 1 hour 30 min’s journey but traffic jam is totally unpredictable.\nWhere to stay:\nThe only stay option is Singell Homestay. It’s a family run homestay with all the necessary amenities and superb hospitality. Three double-bedded room and one four-bedded room are there. Meals are served in the common dining area. You need to book in advance. For booking, contact Aruna Pradhan: +91-8172042608, 9832057237.\nWhen to visit:\nIt can be visited throughout the year. Though I think monsoon will be best to experience rain soaked greenery of Singell. \n', 'North Bengal, Kurseong', '2017-05-16', 1, 1, '20,16,17,18,19,21,22,23'),
(1003, 1, 1, 0, 'Mulkharka Lake Trek', 'Jhilimili is a noted tourist destination, located in the Khatra subdivision of the district of Bankura. It is precisely located at the border of Purulia, Bankura and Midnapur. Situated just 70 kilometers away from the Bankura town, the Jhilmili district is an area of dense and imperturbable natural beauty. The place is perched on a hillock and on your way from Ranibund to Jhilimili you can catch a glimpse of a range of unique sights adorned by dense forests of varying heights. These forests can be seen on both sides of the road.I got to know about this place while going through random travelogues. It’s a natural lake, also called as Wishing Lake, situated in a remote corner of North Bengal close to Sikkim. The main attraction is the reflection of mighty Kanchenjunga in that lake and that was pretty much enough to get me going. I got the phone number of a local guide, Mr. Lalit Poudyal. He is a wonderful person and this whole trip was arranged by him. \nOn the fine evening of 9th March, 2017 me and my brother boarded the bus for Siliguri. As we were only two, we took shared cabs and at around 1 p.m next day we reached Lingsey. It is a remote village in Kalimpong divison, far from the crowd. Two main attractions of Lingsey are Shivalaya Mandir and the Sanskrit Vidhyalaya which has a library of very rare books and old manuscripts. We stayed at Lalit’s place, which is named as Golsimal Homestay. Three wooden rooms were there and the whole place was nicely decorated. Don’t expect anything lavish here but they do their best to make your stay comfortable. A small campfire area was there and it became our favourite place. We spent more time there rather than the room. We were served with a sumptuous lunch. After lunch we went for a walk. The surrounding was so beautiful that we were not able to stay inside the room. We were warned not to go far and when you are in such a remote place always listen to the Locals. It started drizzling and we rushed back to our homestay. Tea with pakora was perfect in that weather. It was a full moon light and moonlight seemed brighter there. What a wonderful night it was! We had chicken and roti in dinner. It started raining heavily at night. It was the first time I was experiencing rain in the hills.\nWhen we woke up next morning it was still raining. And it looks like Mother Nature is taking bath. It was not possible for us to trek in rain so we had to change our plan. Lalit arranged a car for our next destination, Tagathang. The road was fully covered with mist. We were not able to see a single thing out of the car window. I absolutely have no idea how the guy was driving. It was half an hour journey. We stayed at Dilu Chettri’s Homestay and to me it was lot more than a luxurious hotel. The room was very sweet – wooden chairs, divan, a small bed, dressing table, white curtains and the view from the windows was mesmerizing. I was awestruck by the beauty of this place. Rain was almost stopped and we went out for a stroll. A guy from the homestay accompanied us. As we came by car we missed Dhoksing Waterfall, it was on the trek route. We asked Bhaiya if he could take us to the waterfall and he eagerly guided us. The path became dangerous as well as beautiful due to rain and it was literally breathtaking. We passed Jhusing village on the way. This area is the extended part of Neora Valley National Park. While climbing up I was losing my breath frequently. We stopped at a homestay in Jhusing for water and they treated us with tea. What a nice gesture! We came back to our homestay at around 4 pm and had our lunch. After almost 12 kms of trekking and a lip-smacking lunch, a rest was much needed but again I couldn’t keep myself inside the room. And we experienced probably the best sunset of our life. I have never seen so many colors in the sky before. We lost track of time and stood spellbound till the last sunshine faded away. As soon as it became dark, the room was flooded with moonlight. The moon seemed like a high power bulb. I spent hours sitting at the windows.\nNext morning we headed towards Mulkharka and our guide was Ashish. He is a student of class 8 with a sweet smile. It’s only 3 km and we reached our homestay before noon. The place offers a panoramic view of the whole surrounding. We went out to visit the Mulkharka Lake. It took approx. one hour to reach the lake. The lake was calm and there was an unusual silence around the place. There’s a small temple and if you look at the temple from the lake, Mt. Kanchenjungha appears behind it but it was not visible at all. We went back to our homestay. Don’t forget to try the local wine. It’s really good. Again we were gifted with a gorgeous sunset. The temperature dropped rapidly after sunset. We woke up early to see sunrise and I was freezing. I wrapped up myself in a fluffy jacket and started towards the Lake. It took us 45 mins to reach the place and that view was worth all the pain. There was mighty Kanchenjungha bathing with first rays of Sun. The whole valley was white. Dew drops got frozen and it was so unexpected that I couldn’t comprehend at first sight. We just wanted to stay there and look at Kanchenjhungha as long as we could. But we had to leave. We started downhill trek after breakfast and it was a different route. After few hours we reached Mankhim, a hilltop near the popular Aritar Lake. We stayed at Kanchenjungha Mirror Homestay. It’s declared as the best homestay of East Sikkim probably for the excellent view of Kanchenjungha. We spent the day at leisure relishing the beauty of surroundings. It’s a perfect place to unwind from your hectic life with awesome views of Mt. Kanchenjungha. I badly wanted to stay for a couple of more days but work-life was calling. We left for Kolkata next morning with loads of memories and a promise to come again soon.\nHow to Reach Lingsey:\nOur trek started from Lingsey. Nearest Railway Station is New Jalpaiguri (NJP). Lingsey is 104 Km from NJP. You can book direct car from Siliguri, NJP and Gangtok. It is 25 Km from Pedong and 51 Km from Kalimpong.\nYou can also go by shared car. From Siliguri, take shared jeep till Rangpo. It’s on the way towards Gangtok. It will cost Rs 150 per head. Then take another shared car for Rhenock. It will charge Rs 100 per head. From Rhenock, you have to book a car for Lingsey. Shared transport is not much available here.\nBest Time to Visit:\nBest time to visit is March to May and after monsoon September to December.\nTips:\nCarry power bank and extra warm clothes as temperature may fall rapidly. You won’t get shops available so do carry the things you need.\n', 'North Bengal, Sikkim, Trek', '2017-05-01', 1, 1, '1004,1001,1003,1005,1006,1008,1009,1010,1011');

-- --------------------------------------------------------

--
-- Table structure for table `detail`
--

CREATE TABLE IF NOT EXISTS `detail` (
  `placeId` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `placeName` varchar(255) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `images` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `routeDetails` text NOT NULL,
  `visitTime` text NOT NULL,
  `tips` text NOT NULL,
  `relatedPlace` varchar(255) NOT NULL,
  `relatedTransport` text,
  `relatedStay` text,
  `relatedBlogs` varchar(255) DEFAULT NULL,
  `BlogOnly` tinyint(1) NOT NULL DEFAULT '0',
  `isVisible` tinyint(1) NOT NULL DEFAULT '0',
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`placeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail`
--

INSERT INTO `detail` (`placeId`, `Name`, `placeName`, `category`, `description`, `images`, `state`, `country`, `routeDetails`, `visitTime`, `tips`, `relatedPlace`, `relatedTransport`, `relatedStay`, `relatedBlogs`, `BlogOnly`, `isVisible`, `isActive`) VALUES
(1, '', 'Baranti - A small Hamlet in Purulia', 1, 'Baranti is a small village with lash green forest, hills and the one km long Muradi Dam. The nearest railway station is Muradi which is accessible by local train from Asansol or Adra. It''s surely a nice place to get rid of all the stress and enjoy your weekend. The view of sunset is breath-taking. Sit beside the lake or have a walk along the mud road and reach the foothill. This place can be visited around the year but it looks spectacular in Autumn with Palash in full bloom.', '13.11.12.14.15.50', '', '', '', '', '', '', NULL, NULL, '1001', 0, 1, 1),
(2, '', 'Singell Tea Estate -\n Kurseong', 0, 'A lesser known destination close to Kurseong & Darjeeling.It''s only one and half hour away from New Jalpaiguri. You can directly book a car for Singell from NJP or go to Kurseong by shared car first then from Kurseong, it''s a 10  minute''s drive.It will take 20 bucks each in a shared cab. The lavish green surrounding of Alpine Trees and Tea gardens will surely soothe your eye.The Singell Homestay is built in a cliff and it''s managed by two wonderful hosts - Lathika and Aruna. They offer delicious homemade food.The view from the balcony is just perfect - a vast landscape of Singell Tea estate, winding roads, Toytrain track.This place has a touch of colonial period.\n', '20,16,17,18,19,21,22,23', '', '', '', '', '', '', NULL, NULL, '1002', 0, 1, 1),
(3, '', 'Tajpur', 2, 'It is a virgin beach, located in Purba Medinipur, West Bengal near Digha. You can spot numerous red crabs playing Hide and Seek in the sand. It is less crowded and the shacks on the beach provide lip smacking dishes as per your request. You can act totally crazy and don’t have to think about others. There are many resorts and hotels close to the beach.', '26,24,25', '', '', '', '', '', '', NULL, NULL, NULL, 0, 1, 1),
(4, '', 'Gongoni', 0, 'Gongoni, located in the small town of Garhbeta in West Midnapore can be called a miniature version of Grand Canyon of Arizon. It''s a wonder of Mother Nature. Beautiful formations are made through years of soil erosion with the help of the Silabati river. It has a Mythological connection, too. According to Mahabharata, Bak Rakshasa and Bhim had a fight here and these are the scars left from that battle. Garhbeta also has a lot of ancient temples and a direct connection with history. Sarbamangala Temple is the most famous among them. It is assumed to be built at 16th century by some Bagri king. According to local folklore, king Vikramaditya got rid of Betaal by worshipping in this temple. So, a day trip to Garhbeta won''t disappoint you. \n\n', '29,30,31,32', '', '', 'The best way to reach Garbeta is to board Rupasi Bangla express from Santragachi Station at 6.25 am and you will reach Garhbeta around 9.20 am. From there you will get auto-rickshaw for Gongoni khola. One can also drive via Santragachi, Arambagh, Goghat and Kamarpur.\n\n', '', '', '', NULL, NULL, '', 0, 1, 1),
(5, '', 'Jhilimili', 1, 'Jhilimili is a perfect place to spend a day or two in Nature''s lap. It is located at the border of Purulia, Bankura & Midnapur close to Mukutmanipur Dam (The second biggest earthen Dam of India). It has an average elevation of 228 metres (748 ft) and the road from Ranibandh to Jhilimili offers a magnificent view of dense forests with varying heights. It is a treat for eyes and soul. You can spot small adibasi villages on the way. The only stay option there is Rimil Parjatak Nibas. It is on top of a small hillock and surrounded by Sal, Shegun trees. Hotel stuffs are cordial and try their best to make your stay pleasant.', '33,34,35,36', '', '', '', '', '', '', NULL, NULL, '', 0, 1, 1),
(6, '', 'Henry Island', 2, 'If you are looking for a quiet stay near Kolkata then Henry Island would be the perfect choice. It''s near Bakkhali in South 24 Parganas. From Bakkhali, a village road with fishing ponds on its side will take you to Henry Island. A pristine white beach with scattered mangrove trees and red crabs.This place is now being used by West Bengal Fisheries Department for pisiculture and they are taking great initiative to turn it into a tourist spot. There is a watch tower which offers a great panoramic view of the surroundings.', '39,40,41', '', '', 'Nearest railway station is Namkhana. There are regular trains from Sealdah. From Namkhana cross the river and you will get bus or private cars for Bakhhali. There are buses from Esplanade, too. For reservation to stay at Henry Island contact: State Fisheries Development Corporation, Bikash Bhavan. Ph: 23376470.\r\n', '', '', '', NULL, NULL, NULL, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `imageId` int(11) NOT NULL AUTO_INCREMENT,
  `fileName` varchar(255) NOT NULL,
  `path` text NOT NULL,
  `AuthorId` int(11) NOT NULL DEFAULT '1',
  `tags` varchar(255) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `isVisible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`imageId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1012 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`imageId`, `fileName`, `path`, `AuthorId`, `tags`, `isActive`, `isVisible`) VALUES
(1, 'Bhramhatal-1.jpg', 'images/CoverPics/Bhramhatal-1.jpg', 1, NULL, 1, 1),
(2, 'Bhramhatal', 'images/CoverPics/Bhramhatal.jpg', 1, NULL, 1, 1),
(3, 'Heaven', 'images/CoverPics/Heaven.jpg', 1, NULL, 1, 1),
(4, 'Baranti_Sunset2.jpg', 'images\\Baranti\\Baranti_Sunset2.jpg', 1, NULL, 1, 1),
(5, 'Singell_5.jpg', 'images/Singell/Singell_5.jpg', 1, NULL, 1, 1),
(6, 'Tajpur_3.jpg', 'images/Tajpur/Tajpur_3.jpg', 1, NULL, 1, 1),
(7, 'Tagathang-Sunset-3.JPG', 'images/Mulkharka/Tagathang-Sunset-3.JPG', 1, '#Sunset', 1, 1),
(8, 'Jhilimili_1', 'images/Jhilimili/Jhilimili_1.jpg', 1, NULL, 1, 1),
(10, 'HenryIsland_1.jpg', 'images/Henry_Island/HenryIsland_1.jpg', 1, '', 1, 1),
(11, 'Baranti Lake.jpg', 'images\\Baranti\\Baranti_Lake.jpg', 1, NULL, 1, 1),
(12, 'Baranti_Hill.jpg', 'images\\Baranti\\Baranti_Hill.jpg', 1, NULL, 1, 1),
(13, 'Baranti_Sunset2.jpg', 'images\\Baranti\\Baranti_Sunset2.jpg', 1, NULL, 1, 1),
(14, 'Baranti_View_from_room.jpg', 'images\\Baranti\\Baranti_View_from_room.jpg', 1, NULL, 1, 1),
(15, 'Baranti_Sunset1.jpg', 'images\\Baranti\\Baranti_Sunset1.jpg', 1, NULL, 1, 1),
(16, 'Singell_1.jpg', 'images/Singell/Singell_1.jpg', 1, NULL, 1, 1),
(17, 'Singell_2.jpg', 'images/Singell/Singell_2.jpg', 1, NULL, 1, 1),
(18, 'Singell_3.jpg', 'images/Singell/Singell_3.jpg', 1, NULL, 1, 1),
(19, 'Singell_4.jpg', 'images/Singell/Singell_4.jpg', 1, NULL, 1, 1),
(20, 'Singell_5.jpg', 'images/Singell/Singell_5.jpg', 1, NULL, 1, 1),
(21, 'Singell_Evening.JPG', 'images/Singell/Singell_Evening.JPG', 1, '#Evening', 1, 1),
(22, 'Singell_SunSet.JPG', 'images/Singell/Singell_SunSet.JPG', 1, '#Sunset', 1, 1),
(23, 'Singell_View_Point.JPG', 'images/Singell/Singell_View_Point.JPG', 1, NULL, 1, 1),
(24, 'Tajpur_1.jpg', 'images/Tajpur/Tajpur_1.jpg', 1, NULL, 1, 1),
(25, 'Tajpur_2.jpg', 'images/Tajpur/Tajpur_2.jpg', 1, NULL, 1, 1),
(26, 'Tajpur_3.jpg', 'images/Tajpur/Tajpur_3.jpg', 1, NULL, 1, 1),
(27, '', '', 1, NULL, 1, 1),
(28, '', '', 1, NULL, 1, 1),
(29, 'Gangoni_1.jpg', 'images/Gongoni/Gangoni_1.jpg', 1, NULL, 1, 1),
(30, 'Gangoni_2.jpg', 'images/Gongoni/Gangoni_2.jpg', 1, NULL, 1, 1),
(31, 'Gangoni_3.jpg', 'images/Gongoni/Gangoni_3.jpg', 1, NULL, 1, 1),
(32, 'Gangoni_4', 'images/Gongoni/Gangoni_4.jpg', 1, NULL, 1, 1),
(33, 'Jhilimili_1', 'images/Jhilimili/Jhilimili_1.jpg', 1, NULL, 1, 1),
(34, 'Jhilimili_2', 'images/Jhilimili/Jhilimili_2.jpg', 1, NULL, 1, 1),
(35, 'Mukutmanipur_Dam', 'images/Jhilimili/Mukutmanipur_Dam.jpg', 1, NULL, 1, 1),
(36, 'Rimil Lodge_Jhilimili', 'images/Jhilimili/Rimil Lodge_Jhilimili.jpg', 1, '#Lodge', 1, 1),
(37, '', '', 1, NULL, 1, 1),
(38, '', '', 1, NULL, 1, 1),
(39, 'HenryIsland_1.jpg', 'images/Henry_Island/HenryIsland_1.jpg', 1, '', 1, 1),
(40, 'HenryIsland_2.jpg', 'images/Henry_Island/HenryIsland_2.jpg', 1, NULL, 1, 1),
(41, 'HenryIsland_3.jpg', 'images/Henry_island/HenryIsland_3.jpg', 1, '', 1, 1),
(42, '', '', 1, NULL, 1, 1),
(43, '', '', 1, NULL, 1, 1),
(44, '', '', 1, NULL, 1, 1),
(45, '', '', 1, NULL, 1, 1),
(46, 'HenryIsland_3.jpg', 'images/Henry_Island/HenryIsland_3.jpg', 1, NULL, 1, 1),
(50, 'Garpanchkot_Baranti', 'images\\Baranti\\Garpanchkot_Baranti.jpg', 1, NULL, 1, 1),
(1001, 'Mulkharka-1', 'images/Mulkharka/Mulkharka-1.JPG', 1, NULL, 1, 1),
(1002, 'Mulkharka-2', 'images/Mulkharka/Mulkharka-2.JPG', 1, NULL, 1, 1),
(1003, 'Mulkharka-3', 'images/Mulkharka/Mulkharka-3.JPG', 1, NULL, 1, 1),
(1004, 'Mulkharka-Lake.JPG', 'images/Mulkharka/Mulkharka-Lake.JPG', 1, NULL, 1, 1),
(1005, 'Tagathang.JPG', 'images/Mulkharka/Tagathang.JPG', 1, NULL, 1, 1),
(1006, 'Tagathang-Home-Stay.JPG', 'images/Mulkharka/Tagathang-Home-Stay.JPG', 1, NULL, 1, 1),
(1008, 'Tagathang-Sunset-1.JPG', 'images/Mulkharka/Tagathang-Sunset-1.JPG', 1, '#Sunset', 1, 1),
(1009, 'Tagathang-Sunset-2.JPG', 'images/Mulkharka/Tagathang-Sunset-2.JPG', 1, NULL, 1, 1),
(1010, 'Tagathang-Sunset-3.JPG', 'images/Mulkharka/Tagathang-Sunset-3.JPG', 1, '#Sunset', 1, 1),
(1011, 'Tagathang-Sunset-4.JPG', 'images/Mulkharka/Tagathang-Sunset-4.JPG', 1, '#Sunset', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permalink`
--

CREATE TABLE IF NOT EXISTS `permalink` (
  `Url` varchar(255) NOT NULL,
  `BlogId` int(11) NOT NULL,
  `DestinationId` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Keyword` text NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`Url`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permalink`
--

INSERT INTO `permalink` (`Url`, `BlogId`, `DestinationId`, `Title`, `Keyword`, `Description`) VALUES
('Gongoni.php', -1, 4, 'Gongoni', 'Sarbamangala Temple,Weekend Getaways, West Bengal ', 'Gongoni, located in the small town of Garhbeta in West Midnapore can be called a miniature version of Grand Canyon of Arizon. It''s a wonder of Mother Nature. Beautiful formations are made through years of soil erosion with the help of the Silabati river. It has a Mythological connection, too. According to Mahabharata, Bak Rakshasa and Bhim had a fight here and these are the scars left from that battle. Garhbeta also has a lot of ancient temples and a direct connection with history. Sarbamangala Temple is the most famous among them. It is assumed to be built at 16th century by some Bagri king. According to local folklore, king Vikramaditya got rid of Betaal by worshipping in this temple. So, a day trip to Garhbeta won''t disappoint you. \r\n\r\n'),
('Henry-Island.php', -1, 6, 'Henry Island', 'Bakkhali, West Bengal, Beach, Weekend Getaways', 'If you are looking for a quiet stay near Kolkata then Henry Island would be the perfect choice. It''s near Bakkhali in South 24 Parganas. From Bakkhali, a village road with fishing ponds on its side will take you to Henry Island. A pristine white beach with scattered mangrove trees and red crabs.This place is now being used by West Bengal Fisheries Department for pisiculture and they are taking great initiative to turn it into a tourist spot. There is a watch tower which offers a great panoramic view of the surroundings.'),
('http://banzaras.in/Baranti.php', 1001, 1, 'Baranti - A small Hamlet in Purulia', 'WeekendGetaways , Holiday, WestBengal, Baranti', 'Baranti is a small village with lash green forest, hills and the one km long Muradi Dam. The nearest railway station is Muradi which is accessible by local train from Asansol or Adra. It''s surely a nice place to get rid of all the stress and enjoy your weekend. The view of sunset is breath-taking. Sit beside the lake or have a walk along the mud road and reach the foothill. This place can be visited around the year but it looks spectacular in Autumn with Palash in full bloom.'),
('http://banzaras.in/Mulkharka-Lake.php', 1003, 1003, 'Mulkharka Lake Trek - Less explored part of North Bengal', 'Trek, North Bengal, Sikkim, Tagathang, Wishing Lake,Neora Valley National Park ', 'Mulkharka Lake Trek – Less explored part of North Bengal'),
('http://banzaras.in/Singell-Tea-Estate.php', 1002, 2, 'Singell Tea Estate - Kurseong', 'Singell Tea Estate, WeekendGetaways , North Bengal, Holiday, WestBengal, ', 'A lesser known destination close to Kurseong & Darjeeling. It’s only one and half hour away from New Jalpaiguri. You can directly book a car for Singell from NJP or go to Kurseong by shared car first then from Kurseong, it’s a 10  minute’s drive. It will take 20 bucks each in a shared cab. The lavish green surrounding of Alpine Trees and Tea gardens will surely soothe your eye. The Singell Homestay is built in a cliff and it’s managed by two wonderful hosts – Lathika and Aruna. They offer delicious homemade food. The view from the balcony is just perfect - a vast landscape of Singell Tea estate, winding roads, Toytrain track. This place has a touch of colonial period.'),
('Jhilimili.php', -1, 5, 'Jhilimili', 'Jhilimili, Weekend Getaways, West Bengal, Holiday, Mukutmanipur Dam, Ranibandh , Rimil Parjatak Nibas', 'Jhilimili is a perfect place to spend a day or two in Nature’s lap. It is located at the border of Purulia, Bankura & Midnapur close to Mukutmanipur Dam (The second biggest earthen Dam of India). It has an average elevation of 228 metres (748 ft) and the road from Ranibandh to Jhilimili offers a magnificent view of dense forests with varying heights. It is a treat for eyes and soul. You can spot small adibasi villages on the way. The only stay option there is Rimil Parjatak Nibas. It is on top of a small hillock and surrounded by Sal, Shegun trees. Hotel stuffs are cordial and try their best to make your stay pleasant.'),
('Tajpur.php', -1, 3, 'Tajpur', 'Beach, West Bengal, WeekendGetaways, holiday', 'It is a virgin beach, located in Purba Medinipur, West Bengal near Digha. You can spot numerous red crabs playing Hide and Seek in the sand. It is less crowded and the shacks on the beach provide lip smacking dishes as per your request. You can act totally crazy and don’t have to think about others. There are many resorts and hotels close to the beach.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
