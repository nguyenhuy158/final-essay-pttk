-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2022 at 10:35 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `galaxy`
--
CREATE DATABASE IF NOT EXISTS `galaxy` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `galaxy`;

-- --------------------------------------------------------

--
-- Table structure for table `credit_cards`
--

CREATE TABLE `credit_cards` (
  `id` int(11) NOT NULL,
  `credit_id` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `expiration_date` date NOT NULL,
  `cvv_code` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `credit_cards`
--

INSERT INTO `credit_cards` (`id`, `credit_id`, `expiration_date`, `cvv_code`, `description`) VALUES
(1, '111111', '2022-10-10', '444', 'Không giới hạn số lần nạp và số tiền mỗi lần nạp.'),
(2, '222222', '2022-11-11', '443', 'Không giới hạn số lần nạp nhưng chỉ được nạp tối đa 1 triệu/lần '),
(3, '333333', '2022-12-12', '577', 'Khi nạp bằng thẻ này thì luôn nhận được thông báo là \"thẻ hết tiền\"');

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `space` int(11) DEFAULT 100,
  `max_space` int(11) DEFAULT 100,
  `cover` text NOT NULL,
  `price` int(11) NOT NULL DEFAULT 60000,
  `vote` float NOT NULL DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`id`, `name`, `description`, `space`, `max_space`, `cover`, `price`, `vote`) VALUES
(1, 'CHUYẾN PHIÊU LƯU CỦA PIL', 'Ngày xửa ngày xưa, cô bé mồ côi Pil phải miễn cưỡng trở thành công chúa. Ngày nọ, hoàng tử của vương quốc bị tên quan độc ác đầu độc. Pil cùng những người bạn phải đứng lên bảo vệ mình và cả vương quốc.', 100, 100, 'film1.jpg', 60000, 4.8),
(2, 'EM VÀ TRỊNH', 'Cuộc gặp gỡ định mệnh giữa Trịnh Công Sơn và nữ sinh viên Nhật Bản Michiko tại Paris năm 1990 đã mở ra một mối duyên kỳ ngộ. Từ đây bắt đầu hành trình ngược dòng thời gian, khám phá tuổi thanh xuân và tình yêu của người nhạc sĩ tài hoa với các nàng thơ Thanh Thuý, Bích Diễm, Dao Ánh, Khánh Ly, và những tình khúc mà họ lưu lại trong trái tim ông. Bộ phim lãng mạn, mở ra thế giới nhạc Trịnh quyến rũ với những mảnh ghép tình yêu đa sắc, lung linh tuyệt đẹp.', 100, 100, 'film2.jpg', 60000, 5),
(3, 'THẾ GIỚI KHỦNG LONG: LÃNH ĐỊA', ' Bốn năm sau kết thúc Jurassic World: Fallen Kingdom, những con khủng long đã thoát khỏi nơi giam cầm và tiến vào thế giới loài người. Giờ đây, chúng xuất hiện ở khắp mọi nơi. Sinh vật to lớn ấy không còn chỉ ở trên đảo như trước nữa mà gần ngay trước mắt, thậm chí còn có thể chạm tới.\r\n\r\nOwen Grady may mắn gặp lại cô khủng long mà anh và khán giả vô cùng yêu mến - Blue. Tuy nhiên, Blue không đi một mình mà còn đem theo một chú khủng long con khác. Điều này khiến Owen càng quyết tâm bảo vệ mẹ con cô được sinh sống an toàn.\r\n\r\nThế nhưng, hai giống loài quá khác biệt. Liệu có thể tồn tại một kỷ nguyên mà khủng long và con người sống chung một cách hòa bình?', 100, 100, 'film3.jpg', 60000, 5),
(4, 'DORAEMON: NOBITA VÀ CUỘC CHIẾN VŨ TRỤ TÍ HON 2021', 'Tổng thống hành tinh Pirika – Papi trốn đến địa cầu nhằm thoát khỏi sự càn quét của quân phiến loạn. Tình cờ, Nobita nhặt được phi thuyền mini của cậu.\r\n\r\nTuy nhiên, chiến hạm vũ trụ hình cá voi đã đuổi theo Papi đến trái đất, tấn công Doraemon và nhóm Nobita hòng bắt sống Papi. Cảm thấy có trách nhiệm vì liên lụy mọi người, Papi quyết định một mình đương đầu với quân phiến loạn tàn ác…\r\n\r\nĐể bảo vệ người bạn quan trọng và quê hương thân thương của Papi, Doraemon và các bạn lên đường đến hành tinh Pirika!\r\n\r\nBên cạnh các nhân vật quen thuộc như Doraemon, Nobita, Shizuka, Jaian, Suneo, Dekisugi; chúng ta còn gặp gỡ nhiều gương mặt mới của riêng bộ phim như tổng thống Papi, chị gái Pina, chú cún Locoroco, tên độc tài Gilmore…', 100, 100, 'film4.jpg', 60000, 5),
(5, 'PHÙ THỦY TỐI THƯỢNG TRONG ĐA VŨ TRỤ HỖN LOẠN', 'Lỡ tay làm phép khiến đa vũ trụ nảy sinh vấn đề ở Spider-Man: No Way Home, Doctor Strange “trả nghiệp” thế nào trong Doctor Strange In The Multiverse Of Madness?\r\n\r\nCó thể nói, chưa bao giờ Stephen Strange phải đối mặt với nhiều mối nguy như hiện tại. “Scarlet Witch” Wanda Maximoff tẩy não cả thị trấn (WandaVision), Loki và Sylvie quậy tung Cơ quan quản lí phương sai thời gian (Loki) và đỉnh điểm là điều ước thay đổi quá nhiều lần của Spider-Man Peter Parker khiến mọi thứ vô cùng hỗn loạn.\r\n\r\nCố gắng giải quyết vấn đề, Stephen Strange tìm đến Wanda, nhờ cô giúp đỡ. Tuy nhiên, nữ phù thủy vừa trải qua nỗi đau mất đi những người thân yêu cộng thêm tâm tính bất ổn có phải là cộng sự thích hợp? Wanda đáng thương sẽ thành phản diện ở phần này?\r\n\r\nNgười bạn cũ Mordo nay đã quay lưng và trở thành kẻ thù không đội trời chung với  Strange quay trở lại. Gần như chắc chắn, hắn là kẻ ngáng đường.\r\n\r\nChưa dừng lại ở đó, một phiên bản hắc ám của Doctor Strange – mạnh hơn và điên cuồng hơn cũng góp mặt. Gã đến từ đâu và mục đích của gã là gì? Strange hắc ám này là Strange Supreme từng khuấy đảo series What If…?\r\n\r\nBi đát hơn, cô người yêu Christine của Strange sắp bước vào lễ đường mà chú rể chẳng phải là anh.\r\n\r\nĐiểm sáng hiếm hoi là phù thủy tối thượng Wong vẫn sát cánh bên Strange. Ngoài ra, America Chavez sẽ xuất hiện. Cô bé được dự đoán tham gia nhóm Young Avengers cùng Yelena, Kate Bishop và Spider-Man.\r\n\r\nPhù Thủy Tối Thượng Trong Đa Vũ Trụ Hỗn Loạn do Sam Raimi ngồi ghế chỉ đạo. Vị đạo diễn lừng danh này chính là người cầm trịch 3 phần Spider-Man kinh điển mà Tobey Maguire đóng chính.\r\n\r\nPhim quy tụ dàn diễn viên hùng hậu Benedict Cumberbatch, Elizabeth Olsen, Rachel McAdams, Chiwetel Ejiofor, Benedict Wong, Michael Stuhlbarg, Xochitl Gomez…\r\n\r\nSau cú lừa “Tobey Maguire và Andrew Garfiled không tham gia Spider-Man: No Way Home”, danh sách diễn viên “hình như” sẽ cameo Doctor Strange In The Multiverse Of Madness quá khủng. Các nhân vật thuộc nhóm Dị Nhân, Deadpool và Bộ Tứ Siêu Đẳng đều được gọi tên. Loki, Sylvie và Kang (Loki) cùng Người Nhện Tobey Maguire cũng có phần.\r\n\r\nTrailer mới Doctor Strange In The Multiverse Of Madness hé lộ một nhân vật bí ẩn dường như là giáo sư X phiên bản già Patrick Stewart. Cả giáo sư X phiên bản trẻ (James McAvoy) và Jean Grey (Sophie Turner) đều có tin xuất hiện ở phim trường Phù Thủy Tối Thượng Trong Đa Vũ Trụ Hỗn Loạn. Đặc biệt nhất là lời đồn không tưởng về việc Tom Cruise sẽ trở thành Iron Man mới đang lan truyền rộng rãi.', 100, 100, 'film5.jpg', 60000, 5),
(7, 'PHI CÔNG SIÊU ĐẲNG MAVERICK', 'Pete “Maverick” Mitchell từng nổi danh là một phi công thử nghiệm quả cảm hàng đầu của Hải quân. Sau hơn ba mươi năm phục vụ, anh né tránh cơ hội thăng chức khiến bản thân cảm thấy bị bó buộc, để trở về làm chính mình - một đại úy. Trong đợt đào tạo biệt đội tại trường quân sự Top Gun cho nhiệm vụ chuyên biệt chưa từng có, Maverick chạm trán với Trung úy Bradley Bradshaw (Miles Teller) - con trai của người bạn thân quá cố Nick Bradshaw.\r\n\r\nVới nhiệm vụ lần này, không chỉ đối mặt với những thử thách nguy hiểm đến tính mạng, Pete Mitchell còn đối mặt với bóng ma quá khứ, nỗi sợ hãi sâu thẳm trong thâm tâm.', 100, 100, 'film8.jpg', 66000, 5),
(11, 'DAENG: HẬU DUỆ \"TÌNH NGƯỜI DUYÊN MA\"', 'Tiếp nối hội bạn \"Tình Người Duyên Ma\" năm xưa, lần này câu chuyện về cậu bé Daeng hứa hẹn sẽ hài hước hơn và không kém phần kinh dị.\r\n', 100, 100, 'film7.jpg', 60000, 5),
(12, 'EM VÀ TRỊNH', 'Cuộc gặp gỡ định mệnh giữa Trịnh Công Sơn và nữ sinh viên Nhật Bản Michiko tại Paris năm 1990 đã mở ra một mối duyên kỳ ngộ. Từ đây bắt đầu hành trình ngược dòng thời gian, khám phá tuổi thanh xuân và tình yêu của người nhạc sĩ tài hoa với các nàng thơ Thanh Thuý, Bích Diễm, Dao Ánh, Khánh Ly, và những tình khúc mà họ lưu lại trong trái tim ông. Bộ phim lãng mạn, mở ra thế giới nhạc Trịnh quyến rũ với những mảnh ghép tình yêu đa sắc, lung linh tuyệt đẹp.', 100, 100, 'film3.jpg', 60000, 5),
(14, 'Mobile Suit Gundam: Cucuruz Doans Island', 'Bộ phim được chuyển thể từ tập 15 của series anime nổi tiếng Mobile Suit Gundam. Sau trận chiến ở Jaburo, lực lượng liên bang Trái Đất lên kế hoạch cho một chiến dịch đánh chiếm Odessa, trụ sở của Lực lượng tấn công Zeon. Tàu chiến White Base trên đường hướng đến Belfast để tiếp tế thì nhận được một mệnh lệnh mới: tìm đường đến hòn đảo được mệnh danh là \"Đảo Một Đi Không Trở Lại\".\r\n', 100, 100, 'film6.jpg', 60000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `user_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `space` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`user_id`, `film_id`, `space`) VALUES
(40, 1, 3),
(40, 1, 4),
(40, 1, 5),
(40, 1, 17),
(40, 2, 1),
(40, 2, 2),
(40, 2, 3),
(40, 2, 4),
(40, 2, 5),
(40, 2, 6),
(40, 2, 7),
(40, 2, 8),
(40, 2, 9),
(40, 2, 10),
(40, 2, 27),
(40, 2, 35),
(40, 2, 42),
(40, 2, 47),
(40, 2, 56),
(40, 3, 6),
(40, 5, 35),
(57, 1, 6),
(58, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `networks`
--

CREATE TABLE `networks` (
  `id` int(11) NOT NULL,
  `network_name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `pre` varchar(5) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `create_at` datetime DEFAULT '0000-01-01 00:00:00',
  `update_at` datetime DEFAULT '0000-01-01 00:00:00',
  `money` int(11) NOT NULL,
  `user_root` int(11) NOT NULL,
  `user_des` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `fee` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `internet_provider` varchar(20) DEFAULT NULL,
  `recharge_card` varchar(20) DEFAULT NULL,
  `card_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `create_at`, `update_at`, `money`, `user_root`, `user_des`, `type`, `message`, `fee`, `status`, `internet_provider`, `recharge_card`, `card_code`) VALUES
(26, '2022-05-31 12:24:34', '2022-05-31 12:24:34', 2, 40, NULL, 4, NULL, 0, 1, '33333', '20000', '3333365897'),
(27, '2022-05-31 12:24:34', '2022-05-31 12:24:34', 2, 40, NULL, 4, NULL, 0, 1, '33333', '20000', '3333317758'),
(28, '2022-05-31 12:25:14', '2022-05-31 12:25:14', 2, 40, NULL, 4, NULL, 0, 1, '33333', '20000', '3333346157'),
(29, '2022-05-31 12:25:14', '2022-05-31 12:25:14', 2, 40, NULL, 4, NULL, 0, 1, '33333', '20000', '3333394111'),
(30, '2022-05-31 12:25:27', '2022-05-31 12:25:27', 2, 40, NULL, 4, NULL, 0, 1, '33333', '20000', '3333381752'),
(31, '2022-05-31 12:25:27', '2022-05-31 12:25:27', 2, 40, NULL, 4, NULL, 0, 1, '33333', '20000', '3333374203'),
(32, '2022-05-31 12:25:59', '2022-05-31 12:25:59', 2, 40, NULL, 4, NULL, 0, 1, '33333', '20000', '3333355375'),
(33, '2022-05-31 12:25:59', '2022-05-31 12:25:59', 2, 40, NULL, 4, NULL, 0, 1, '33333', '20000', '3333386634'),
(34, '2022-05-31 12:26:02', '2022-05-31 12:26:02', 2, 40, NULL, 4, NULL, 0, 1, '33333', '20000', '3333322975'),
(35, '2022-05-31 12:26:02', '2022-05-31 12:26:02', 2, 40, NULL, 4, NULL, 0, 1, '33333', '20000', '3333397805'),
(36, '2022-05-31 12:26:31', '2022-05-31 12:26:31', 2, 40, NULL, 4, NULL, 0, 1, '33333', '20000', '3333377211'),
(37, '2022-05-31 12:26:31', '2022-05-31 12:26:31', 2, 40, NULL, 4, NULL, 0, 1, '33333', '20000', '3333330271'),
(38, '2022-05-31 12:27:46', '2022-05-31 12:27:46', 1, 40, NULL, 4, NULL, 0, 1, '11111', '10000', '1111132167'),
(39, '2022-05-31 12:27:49', '2022-05-31 12:27:49', 1, 40, NULL, 4, NULL, 0, 1, '11111', '10000', '1111130997'),
(40, '2022-05-31 12:33:20', '2022-05-31 12:33:20', 1, 40, NULL, 4, NULL, 0, 1, '11111', '10000', '1111149426'),
(41, '2022-05-31 12:33:23', '2022-05-31 12:33:23', 1, 40, NULL, 4, NULL, 0, 1, '11111', '10000', '1111133641'),
(42, '2022-05-31 12:33:26', '2022-05-31 12:33:26', 1, 40, NULL, 4, NULL, 0, 1, '11111', '10000', '1111186674'),
(43, '2022-05-31 12:33:56', '2022-05-31 12:33:56', 1, 40, NULL, 4, NULL, 0, 1, '11111', '10000', '1111157885'),
(44, '2022-05-31 12:39:40', '2022-05-31 12:39:40', 3, 40, NULL, 4, NULL, 0, 1, '11111', '10000', '1111150324'),
(45, '2022-05-31 12:39:40', '2022-05-31 12:39:40', 3, 40, NULL, 4, NULL, 0, 1, '11111', '10000', '1111189047'),
(46, '2022-05-31 12:39:40', '2022-05-31 12:39:40', 3, 40, NULL, 4, NULL, 0, 1, '11111', '10000', '1111195311'),
(47, '2022-05-31 12:41:05', '2022-05-31 12:41:05', 1000000000, 40, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(48, '2022-05-31 12:41:14', '2022-05-31 12:41:14', 1, 40, NULL, 4, NULL, 0, 1, '11111', '10000', '1111126383'),
(49, '2022-05-31 12:41:24', '2022-05-31 12:41:24', 3, 40, NULL, 4, NULL, 0, 1, '11111', '50000', '1111143358'),
(50, '2022-05-31 12:41:24', '2022-05-31 12:41:24', 3, 40, NULL, 4, NULL, 0, 1, '11111', '50000', '1111187986'),
(51, '2022-05-31 12:41:24', '2022-05-31 12:41:24', 3, 40, NULL, 4, NULL, 0, 1, '11111', '50000', '1111118355'),
(52, '2022-05-31 12:41:34', '2022-05-31 12:41:34', 4, 40, NULL, 4, NULL, 0, 1, '33333', '50000', '3333321518'),
(53, '2022-05-31 12:41:34', '2022-05-31 12:41:34', 4, 40, NULL, 4, NULL, 0, 1, '33333', '50000', '3333331725'),
(54, '2022-05-31 12:41:34', '2022-05-31 12:41:34', 4, 40, NULL, 4, NULL, 0, 1, '33333', '50000', '3333368717'),
(55, '2022-05-31 12:41:34', '2022-05-31 12:41:34', 4, 40, NULL, 4, NULL, 0, 1, '33333', '50000', '3333356822'),
(56, '2022-05-31 12:46:38', '2022-05-31 12:46:38', 3, 40, NULL, 4, NULL, 0, 1, '11111', '10000', '1111117629'),
(57, '2022-05-31 12:46:38', '2022-05-31 12:46:38', 3, 40, NULL, 4, NULL, 0, 1, '11111', '10000', '1111145899'),
(58, '2022-05-31 12:46:38', '2022-05-31 12:46:38', 3, 40, NULL, 4, NULL, 0, 1, '11111', '10000', '1111150642'),
(59, '2022-05-31 12:47:36', '2022-05-31 12:47:36', 5, 40, NULL, 4, NULL, 0, 1, '33333', '100000', '3333397127'),
(60, '2022-05-31 12:47:36', '2022-05-31 12:47:36', 5, 40, NULL, 4, NULL, 0, 1, '33333', '100000', '3333362677'),
(61, '2022-05-31 12:47:36', '2022-05-31 12:47:36', 5, 40, NULL, 4, NULL, 0, 1, '33333', '100000', '3333380841'),
(62, '2022-05-31 12:47:36', '2022-05-31 12:47:36', 5, 40, NULL, 4, NULL, 0, 1, '33333', '100000', '3333316884'),
(63, '2022-05-31 12:47:36', '2022-05-31 12:47:36', 5, 40, NULL, 4, NULL, 0, 1, '33333', '100000', '3333382539'),
(64, '2022-05-31 12:49:06', '2022-05-31 12:49:06', 5, 40, NULL, 4, NULL, 0, 1, '33333', '100000', '3333341143'),
(65, '2022-05-31 12:49:06', '2022-05-31 12:49:06', 5, 40, NULL, 4, NULL, 0, 1, '33333', '100000', '3333337392'),
(66, '2022-05-31 12:49:06', '2022-05-31 12:49:06', 5, 40, NULL, 4, NULL, 0, 1, '33333', '100000', '3333395198'),
(67, '2022-05-31 12:49:06', '2022-05-31 12:49:06', 5, 40, NULL, 4, NULL, 0, 1, '33333', '100000', '3333344030'),
(68, '2022-05-31 12:49:06', '2022-05-31 12:49:06', 5, 40, NULL, 4, NULL, 0, 1, '33333', '100000', '3333322866'),
(69, '2022-05-31 12:49:35', '2022-05-31 12:49:35', 5, 40, NULL, 4, NULL, 0, 1, '33333', '100000', '3333349648'),
(70, '2022-05-31 12:49:35', '2022-05-31 12:49:35', 5, 40, NULL, 4, NULL, 0, 1, '33333', '100000', '3333396007'),
(71, '2022-05-31 12:49:35', '2022-05-31 12:49:35', 5, 40, NULL, 4, NULL, 0, 1, '33333', '100000', '3333331970'),
(72, '2022-05-31 12:49:35', '2022-05-31 12:49:35', 5, 40, NULL, 4, NULL, 0, 1, '33333', '100000', '3333316829'),
(73, '2022-05-31 12:49:35', '2022-05-31 12:49:35', 5, 40, NULL, 4, NULL, 0, 1, '33333', '100000', '3333388109'),
(77, '2022-05-31 12:53:46', '2022-05-31 12:53:46', 3, 40, NULL, 4, NULL, 0, 1, '33333', '100000', '3333310301'),
(78, '2022-05-31 12:53:46', '2022-05-31 12:53:46', 3, 40, NULL, 4, NULL, 0, 1, '33333', '100000', '3333378971'),
(79, '2022-05-31 12:53:46', '2022-05-31 12:53:46', 3, 40, NULL, 4, NULL, 0, 1, '33333', '100000', '3333331117'),
(80, '2022-05-31 12:59:43', '2022-05-31 12:59:43', 5, 40, NULL, 4, NULL, 0, 1, '11111', '100000', '1111169611'),
(81, '2022-05-31 12:59:43', '2022-05-31 12:59:43', 5, 40, NULL, 4, NULL, 0, 1, '11111', '100000', '1111190163'),
(82, '2022-05-31 12:59:43', '2022-05-31 12:59:43', 5, 40, NULL, 4, NULL, 0, 1, '11111', '100000', '1111182850'),
(83, '2022-05-31 12:59:43', '2022-05-31 12:59:43', 5, 40, NULL, 4, NULL, 0, 1, '11111', '100000', '1111119170'),
(84, '2022-05-31 12:59:43', '2022-05-31 12:59:43', 5, 40, NULL, 4, NULL, 0, 1, '11111', '100000', '1111164224'),
(85, '2022-05-31 09:55:27', '2022-05-31 09:55:27', 10000000, 40, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(86, '2022-05-31 11:11:45', '2022-05-31 11:11:45', 1, 40, NULL, 4, NULL, 0, 1, '33333', '100000', '3333310936'),
(87, '2022-05-31 11:15:53', '2022-05-31 11:15:53', 1, 40, NULL, 4, NULL, 0, 1, '11111', '10000', '1111162730'),
(88, '2022-05-31 11:18:02', '2022-05-31 11:18:02', 4, 40, NULL, 4, NULL, 0, 1, '22222', '50000', '2222249540'),
(89, '2022-05-31 11:18:02', '2022-05-31 11:18:02', 4, 40, NULL, 4, NULL, 0, 1, '22222', '50000', '2222263359'),
(90, '2022-05-31 11:18:02', '2022-05-31 11:18:02', 4, 40, NULL, 4, NULL, 0, 1, '22222', '50000', '2222278389'),
(91, '2022-05-31 11:18:02', '2022-05-31 11:18:02', 4, 40, NULL, 4, NULL, 0, 1, '22222', '50000', '2222232572'),
(92, '2022-05-31 04:05:42', '2022-05-31 04:05:42', 10000, 50, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(93, '2022-05-31 04:06:08', '2022-05-31 04:06:08', 1000000, 50, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(94, '2022-05-31 04:06:52', '2022-05-31 04:06:52', 1, 50, NULL, 4, NULL, 0, 1, '11111', '10000', '1111118271'),
(95, '2022-05-31 04:07:04', '2022-05-31 04:07:04', 4, 50, NULL, 4, NULL, 0, 1, '11111', '10000', '1111139893'),
(96, '2022-05-31 04:07:04', '2022-05-31 04:07:04', 4, 50, NULL, 4, NULL, 0, 1, '11111', '10000', '1111153118'),
(97, '2022-05-31 04:07:05', '2022-05-31 04:07:05', 4, 50, NULL, 4, NULL, 0, 1, '11111', '10000', '1111144651'),
(98, '2022-05-31 04:07:05', '2022-05-31 04:07:05', 4, 50, NULL, 4, NULL, 0, 1, '11111', '10000', '1111143841'),
(99, '2022-05-31 04:07:18', '2022-05-31 04:07:18', 2, 50, NULL, 4, NULL, 0, 1, '22222', '50000', '2222299144'),
(100, '2022-05-31 04:07:18', '2022-05-31 04:07:18', 2, 50, NULL, 4, NULL, 0, 1, '22222', '50000', '2222250803'),
(101, '2022-05-31 04:07:29', '2022-05-31 04:07:29', 5, 50, NULL, 4, NULL, 0, 1, '11111', '100000', '1111145265'),
(102, '2022-05-31 04:07:29', '2022-05-31 04:07:29', 5, 50, NULL, 4, NULL, 0, 1, '11111', '100000', '1111180845'),
(103, '2022-05-31 04:07:29', '2022-05-31 04:07:29', 5, 50, NULL, 4, NULL, 0, 1, '11111', '100000', '1111151957'),
(104, '2022-05-31 04:07:29', '2022-05-31 04:07:29', 5, 50, NULL, 4, NULL, 0, 1, '11111', '100000', '1111190606'),
(105, '2022-05-31 04:07:29', '2022-05-31 04:07:29', 5, 50, NULL, 4, NULL, 0, 1, '11111', '100000', '1111152485'),
(106, '2022-06-01 04:23:49', '2022-06-01 04:23:49', 1000, 40, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(107, '2022-06-14 09:10:07', '2022-06-14 09:10:07', 80000, 40, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(108, '2022-06-14 09:10:34', '2022-06-14 09:10:34', 1, 40, NULL, 4, NULL, 0, 1, '11111', '10000', '1111191580'),
(109, '2022-06-14 09:29:40', '2022-06-14 09:29:40', 60000, 40, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(110, '2022-06-14 09:49:02', '2022-06-14 09:49:02', 100000, 56, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(111, '2022-06-14 09:50:40', '2022-06-14 09:50:40', 2, 56, NULL, 4, NULL, 0, 1, '11111', '10000', '1111148454'),
(112, '2022-06-14 09:50:40', '2022-06-14 09:50:40', 2, 56, NULL, 4, NULL, 0, 1, '11111', '10000', '1111189446'),
(113, '2022-06-14 09:58:27', '2022-06-14 09:58:27', 100000, 57, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(114, '2022-06-14 10:30:10', '2022-06-14 10:30:10', 100000, 58, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(115, '2022-06-14 10:30:39', '2022-06-14 10:30:39', 1, 58, NULL, 4, NULL, 0, 1, '11111', '10000', '1111110881');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `front_image` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `back_image` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `otp` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `otp_time` datetime DEFAULT '0000-01-01 00:00:00',
  `isFirst` int(11) NOT NULL DEFAULT 1,
  `wrong_count` int(11) NOT NULL DEFAULT 3,
  `wrong_time` datetime DEFAULT '0000-01-01 00:00:00',
  `warming` int(11) NOT NULL DEFAULT 0,
  `create_at` date NOT NULL,
  `update_at` date NOT NULL,
  `money` int(11) NOT NULL DEFAULT 0,
  `isVerification` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `phone`, `email`, `full_name`, `birthday`, `address`, `front_image`, `back_image`, `username`, `password`, `otp`, `otp_time`, `isFirst`, `wrong_count`, `wrong_time`, `warming`, `create_at`, `update_at`, `money`, `isVerification`) VALUES
(58, '0837377111', 'hyquaq125@gmail.com', 'Nguyen Huy', '0011-11-11', 'Quốc lộ 1A', 'froDC86.tmp.jpg', 'bacDC87.tmp.jpg', '6566027065', 'df200dd224ad34bcaef976c29d1167b2', '', '0000-01-01 00:00:00', 1, 3, '0000-01-01 00:00:00', 0, '2022-06-14', '2022-06-14', 30000, 3),
(57, '0837377811', 'hyquaq151@gmail.com', 'Nguyen Huy', '0001-11-11', 'Quốc lộ 1A', 'fro794B.tmp.png', 'bac794C.tmp.jpg', '7787833395', '6e16e5a127ea7f15b636a571e107c12a', '', '0000-01-01 00:00:00', 1, 3, '0000-01-01 00:00:00', 0, '2022-06-14', '2022-06-14', 40000, 3),
(6, '0837377850', 'hyquaq@gmail.com', 'Nguyen Huy', '2022-05-25', '', 'root.jpg', 'root.jpg', 'admin', '5d515883d372103eca268a8577dbf9b5', '2ef249c2b0f45431de139b4ddee4749d', '2022-05-31 02:45:05', 1, 3, '0000-01-01 00:00:00', 0, '2022-05-25', '2022-05-25', 45000, 3),
(39, '0837377851', '52000668@student.tdtu.edu.vn', 'Nguyễn Huy', '2022-05-11', 'Quốc lộ 1A', 'front-imagesA5kyZ.jpg', 'back-image7wPii2.jpg', '6174342371', 'aa9b7e171598257832850cf4ce6da137', 'a60f4ae62717d2c59bfa356621cbf5c5', '2022-05-31 02:47:53', 1, 3, '2000-01-12 00:00:00', 0, '2022-05-30', '2022-05-30', 11242556, 3),
(40, '0837377852', '32001113@student.tdtu.edu.vn', 'Nguyễn Huy', '2022-05-30', 'Quốc lộ 1A', 'front-imageqyuBO4.jpg', 'back-image4qT7t4.jpg', '1533805372', 'ebb98ee24be581fae4383fcd3144cc38', 'ef91c452c4d881918ffe4ab94afc62df', '2022-05-31 04:17:20', 1, 3, '0000-01-01 00:00:00', 0, '2022-05-30', '2022-05-30', 50000, 3),
(56, '0837377853', 'hyquaq15@gmail.com', 'Nguyen Huy', '0001-11-11', 'Quốc lộ 1A', 'froF492.tmp.png', 'bacF493.tmp.png', '5737484765', '345af3d5cd44312dec3c8f35e0bd6116', '', '0000-01-01 00:00:00', 1, 3, '0000-01-01 00:00:00', 0, '2022-06-14', '2022-06-14', 20000, 3),
(50, '0852000867', '5200867@student.tdtu.edu.vn', 'Nguyễn Huy', '2022-05-31', 'HCM', 'front-imageVCpXX0.jpg', 'back-imageD3Kwq2.jpg', '5452532271', '55ded369eed0ae2043987632cf116c3a', '', '0000-01-01 00:00:00', 1, 3, '0000-01-01 00:00:00', 0, '2022-05-31', '2022-05-31', 299500, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `credit_cards`
--
ALTER TABLE `credit_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`user_id`,`film_id`,`space`) USING BTREE,
  ADD KEY `film_id` (`film_id`);

--
-- Indexes for table `networks`
--
ALTER TABLE `networks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_root` (`user_root`),
  ADD KEY `FK_user_des` (`user_des`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`phone`,`email`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `credit_cards`
--
ALTER TABLE `credit_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `networks`
--
ALTER TABLE `networks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `film_id` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`),
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `FK_user_des` FOREIGN KEY (`user_des`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_user_root` FOREIGN KEY (`user_root`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
