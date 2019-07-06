-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 03, 2018 at 09:07 AM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myjourneymap`
--

-- --------------------------------------------------------

--
-- Table structure for table `map_admin`
--

CREATE TABLE `map_admin` (
  `admin_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_ip` int(50) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_ip` varchar(50) NOT NULL,
  `admin_slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `map_admin`
--

INSERT INTO `map_admin` (`admin_id`, `firstname`, `lastname`, `user_name`, `email`, `password`, `level`, `created_date`, `created_ip`, `modified_date`, `modified_ip`, `admin_slug`) VALUES
(1, 'KATHAK', 'DABHI', 'admin', 'kathak@mxicoders.com', '98b2d473bbfba81df42e345266de90b0e3264f82', 1, '0000-00-00 00:00:00', 0, '2018-01-27 01:20:27', '43.228.96.56', 'Peter_Fischer_26361'),
(2, 'Peter', 'Fischer', 'admin1', 'peterfischerflorez1@gmail.com', '7a6a6794c91e2420820cfcb9c0df73fd0c4973a8', 1, '0000-00-00 00:00:00', 0, '2017-01-30 19:06:01', '83.57.162.120', 'Peter_Fischer_26362');

-- --------------------------------------------------------

--
-- Table structure for table `map_coupons`
--

CREATE TABLE `map_coupons` (
  `coupon_id` int(11) NOT NULL,
  `coupon_name` varchar(255) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `discount` decimal(5,2) NOT NULL,
  `expired_datetime` datetime NOT NULL,
  `total_use` smallint(6) NOT NULL DEFAULT '0',
  `created_datetime` datetime NOT NULL,
  `created_ip` varchar(61) NOT NULL,
  `modified_datetime` datetime NOT NULL,
  `modified_ip` varchar(61) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `map_coupons`
--

INSERT INTO `map_coupons` (`coupon_id`, `coupon_name`, `coupon_code`, `discount`, `expired_datetime`, `total_use`, `created_datetime`, `created_ip`, `modified_datetime`, `modified_ip`) VALUES
(30, '50% Unlimied', '58c3802b', '50.00', '2017-03-24 23:59:59', 3, '2017-03-10 10:42:19', '43.228.96.31', '2017-03-10 11:01:16', '43.228.96.31'),
(32, 'test', '100', '100.00', '2017-03-30 23:59:59', 0, '2017-03-12 03:28:54', '83.41.13.29', '2017-03-12 03:28:54', '83.41.13.29');

-- --------------------------------------------------------

--
-- Table structure for table `map_customer`
--

CREATE TABLE `map_customer` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `created_ip` varchar(61) NOT NULL,
  `modified_datetime` datetime NOT NULL,
  `modified_ip` varchar(61) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `map_faq`
--

CREATE TABLE `map_faq` (
  `faq_id` int(11) NOT NULL,
  `question` varchar(250) NOT NULL,
  `answer` varchar(250) NOT NULL,
  `status` enum('Enable','Disable') NOT NULL,
  `faq_slug` varchar(50) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `created_ip` varchar(50) NOT NULL,
  `modified_datetime` datetime NOT NULL,
  `modified_ip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `map_faq`
--

INSERT INTO `map_faq` (`faq_id`, `question`, `answer`, `status`, `faq_slug`, `created_datetime`, `created_ip`, `modified_datetime`, `modified_ip`) VALUES
(5, 'What is my journey map?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy\r\ntext ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 'Enable', '', '2016-11-11 03:52:15', '88.0.180.14', '2017-07-04 07:10:01', '43.228.96.25'),
(21, 'My city is not seen', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy\r\ntext ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 'Enable', '', '2017-07-04 07:10:17', '43.228.96.25', '2017-07-04 07:10:17', '43.228.96.25'),
(22, 'What is your privacy policy?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy\r\ntext ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 'Enable', '', '2017-07-04 07:10:30', '43.228.96.25', '2017-07-04 07:10:30', '43.228.96.25'),
(23, 'I would like to distribute your posters, how can I do it?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy\r\ntext ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 'Enable', '', '2017-07-04 07:10:48', '43.228.96.25', '2017-07-04 07:10:48', '43.228.96.25'),
(24, 'How are posters sent?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy\r\ntext ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 'Enable', '', '2017-07-04 07:11:07', '43.228.96.25', '2017-07-04 07:11:07', '43.228.96.25'),
(25, ' To what countries can I send my order?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy\r\ntext ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 'Enable', '', '2017-07-04 07:11:23', '43.228.96.25', '2017-07-04 07:11:23', '43.228.96.25'),
(26, 'How long will it take to get my poster?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy\r\ntext ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 'Enable', '', '2017-07-04 07:11:36', '43.228.96.25', '2017-07-04 07:11:36', '43.228.96.25'),
(27, 'What is the form of payment?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy\r\ntext ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 'Enable', '', '2017-07-04 07:11:46', '43.228.96.25', '2017-07-04 07:11:46', '43.228.96.25');

-- --------------------------------------------------------

--
-- Table structure for table `map_mailformat`
--

CREATE TABLE `map_mailformat` (
  `mail_id` bigint(20) NOT NULL,
  `title` text NOT NULL,
  `variables` text NOT NULL,
  `subject` varchar(255) NOT NULL,
  `mailformat` text NOT NULL,
  `insertdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `insertip` varchar(50) NOT NULL,
  `editdatetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `map_mailformat`
--

INSERT INTO `map_mailformat` (`mail_id`, `title`, `variables`, `subject`, `mailformat`, `insertdatetime`, `insertip`, `editdatetime`, `editip`) VALUES
(1, 'Master admin: Forget Password', '<font style="background:#FFFFE0">%sitename%</font>  -> Provide Sitename<br/> ', 'Master admin: Forget Password', '<p> 	Dear %name%,</p> <p> 	Your new password link is %password_link%,</p> <p> 	Thank You,</p> <p> 	%site_name%</p>', '2016-05-02 06:14:32', '', '0000-00-00 00:00:00', ''),
(2, 'Customer: Invoice ', '<font style="background:#FFFFE0">%sitename%</font>  -> Provide Sitename<br/> ', 'Bill MyJourneyMap', '<div style="width:100%;margin:auto;padding:15px;border:1px solid #eee;box-shadow:0 0 10px rgba(0, 0, 0, .15);font-size:16px;line-height:24px;font-family:\'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif;color:#555;">\r\n	<table cellpadding="0" cellspacing="0" style="width:100%;line-height:inherit;text-align:left;">\r\n		<tbody>\r\n			<tr class="top">\r\n				<td colspan="5">\r\n					<table style="width:100%;line-height:inherit;text-align:left;">\r\n						<tbody>\r\n							<tr>\r\n								<td class="title" style="padding:5px;vertical-align:top;padding-bottom:20px;font-size:45px;line-height:45px;color:#333;">\r\n									<img src="http://myjourneymap.net/img/logo.png" style="width: 251px; max-width: 300px; height: 60px;" /></td>\r\n								<td style="padding:5px;vertical-align:top;padding-bottom:20px;text-align: right;">\r\n									Bill#: {%invoice_no%}<br />\r\n									Date: {%invoice_date%}</td>\r\n							</tr>\r\n						</tbody>\r\n					</table>\r\n				</td>\r\n			</tr>\r\n			<tr class="information">\r\n				<td colspan="5">\r\n					<table style="width:100%;line-height:inherit;text-align:left;">\r\n						<tbody>\r\n							<tr>\r\n								<td style="padding:5px;vertical-align:top;padding-bottom:40px;">\r\n									{%owner_name%}<br />\r\n									{%owner_location%}<br />\r\n									{%owner_phone}<br />\r\n									{%owner_email}</td>\r\n								<td style="padding:5px;vertical-align:top;padding-bottom:40px;text-align: right;">\r\n									{%customer_name%}<br />\r\n									{%customer_location}<br />\r\n									{%customer_mobile}<br />\r\n									{%customer_email}</td>\r\n							</tr>\r\n						</tbody>\r\n					</table>\r\n				</td>\r\n			</tr>\r\n			<tr class="heading">\r\n				<td style="padding:5px;vertical-align:top;background:#eee;border-bottom:1px solid #ddd;font-weight:bold;">\r\n					MAP</td>\r\n				<td style="padding:5px;vertical-align:top;background:#eee;border-bottom:1px solid #ddd;font-weight:bold;">\r\n					Characteristics</td>\r\n				<td class="text-center" style="text-align:center !important;padding:5px;vertical-align:top;background:#eee;border-bottom:1px solid #ddd;font-weight:bold;">\r\n					Quantity</td>\r\n				<td class="text-center" style="text-align:center !important;padding:5px;vertical-align:top;background:#eee;border-bottom:1px solid #ddd;font-weight:bold;">\r\n					Prize</td>\r\n				<td style="padding: 5px; vertical-align: top; background: rgb(238, 238, 238); border-bottom: 1px solid rgb(221, 221, 221); font-weight: bold; text-align: right;">\r\n					Total</td>\r\n			</tr>\r\n			<!--row_start-->\r\n			<tr class="item">\r\n				<td style="padding:5px;vertical-align:top;border-bottom:1px solid #eee;">\r\n					<p>\r\n						{%map_name%}<br />\r\n						{%map_desc%}<br />\r\n						{%map_tagline%}</p>\r\n				</td>\r\n				<td style="padding:5px;vertical-align:top;border-bottom:1px solid #eee;">\r\n					<p>\r\n						{%poster_size%},{%poster_orintation%},<br />\r\n						{%poster_style%},{%finsh_style%}</p>\r\n				</td>\r\n				<td class="text-center" style="text-align:center !important;padding:5px;vertical-align:top;border-bottom:1px solid #eee;">\r\n					{%map_qty%}</td>\r\n				<td class="text-center" style="text-align:center !important;padding:5px;vertical-align:top;border-bottom:1px solid #eee;">\r\n					{%map_price%}</td>\r\n				<td style="padding: 5px; vertical-align: top; text-align: right;">\r\n					{%map_price%}</td>\r\n			</tr>\r\n			<!--row_end--><!--discount_row_start-->\r\n			<tr class="total">\r\n				<td style="padding:5px;vertical-align:top;">\r\n					&nbsp;</td>\r\n				<td style="padding:5px;vertical-align:top;">\r\n					&nbsp;</td>\r\n				<td style="padding:5px;vertical-align:top;">\r\n					&nbsp;</td>\r\n				<td style="padding: 5px; vertical-align: top; text-align: right;">\r\n					<p style="font-weight: bold; text-align: right;">\r\n						Subtotal:<br />\r\n						Discount:</p>\r\n				</td>\r\n				<td style="padding: 5px; vertical-align: top; border-top: 2px solid rgb(238, 238, 238); font-weight: bold; text-align: right;">\r\n					<p>\r\n						{%subtotal_amount%}&nbsp;&euro;<br />\r\n						{%discount%} %</p>\r\n				</td>\r\n			</tr>\r\n			<!--discount_row_end-->\r\n			<tr class="total">\r\n				<td style="padding:5px;vertical-align:top;">\r\n					&nbsp;</td>\r\n				<td style="padding:5px;vertical-align:top;">\r\n					&nbsp;</td>\r\n				<td style="padding:5px;vertical-align:top;">\r\n					&nbsp;</td>\r\n				<td style="padding: 5px; vertical-align: top; text-align: right;">\r\n					<span style="font-weight: bold; text-align: right;">Total:</span></td>\r\n				<td style="padding: 5px; vertical-align: top; border-top: 2px solid rgb(238, 238, 238); font-weight: bold; text-align: right;">\r\n					&nbsp;{%total_amount%}&nbsp;&euro;</td>\r\n			</tr>\r\n		</tbody>\r\n	</table>\r\n</div>\r\n<p class="thankyou">\r\n	<span style="background: #45D06B;border-radius: 5px;color: #fff;display: table;float: none;font-size: 51px;margin: 30px auto 20px;padding: 10px 25px;font-family: roboto;">Thank You</span></p>\r\n', '2016-05-02 06:14:32', '', '0000-00-00 00:00:00', ''),
(3, 'Contact Form', '<font style="background:#FFFFE0">%sitename%</font>  -> Provide Sitename<br/> ', 'Contact from MyJourneyMap', '<div style="width:100%;margin:auto;padding:15px;border:1px solid #eee;box-shadow:0 0 10px rgba(0, 0, 0, .15);font-size:16px;line-height:24px;font-family:\'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif;color:#555;">\r\n	Name: {%name%}<br />\r\n	Email:{%email%}<br />\r\n	Phone:{%phone%}<br />\r\n	Message:{%Message%}</div>\r\n', '2016-05-02 06:14:32', '', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `map_map`
--

CREATE TABLE `map_map` (
  `map_id` int(11) NOT NULL,
  `height` float NOT NULL,
  `width` float NOT NULL,
  `map_image` varchar(255) DEFAULT NULL,
  `searchtext` varchar(255) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `tag_line` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `created_ip` varchar(61) NOT NULL,
  `modified_datetime` datetime NOT NULL,
  `modified_ip` varchar(61) NOT NULL,
  `map_properties` text NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `order_id` int(11) NOT NULL,
  `map_pdf` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `map_map`
--

INSERT INTO `map_map` (`map_id`, `height`, `width`, `map_image`, `searchtext`, `title`, `tag_line`, `description`, `created_datetime`, `created_ip`, `modified_datetime`, `modified_ip`, `map_properties`, `qty`, `price`, `order_id`, `map_pdf`) VALUES
(1, 45.72, 30.48, '1_1514199740.jpg', '', 'Madrid', '40.39°N / -3.70°W', 'Spain', '2017-12-25 10:58:38', '43.228.96.48', '2017-12-25 11:02:25', '', 'eyJjb3VudHJ5IjoiVW5pdGVkIFN0YXRlcyIsImNvdW50cnlDb2RlIjoidXMiLCJsYXRpdHVkZSI6NDAuMzk2MTIwMDAwMDAxLCJsb25naXR1ZGUiOi0zLjcwNzQxOTk5OTk4ODQsInBvc3RlclN0eWxlIjoiY2xlYW4iLCJwb3N0ZXJTdHlsZVZhbHVlIjoiQ2xlYW4iLCJtYXBTdHlsZSI6Im1hcGJveDovL3N0eWxlcy90cmF2ZWxtYXBzL2NqOXMzYzFnaTFvMmQyc3A1MjlmdXoxcmsiLCJzdGF0aWNBUEkiOiJodHRwczovL2FwaS5tYXBib3guY29tL3N0eWxlcy92MS90cmF2ZWxtYXBzL2NqOXMzYzFnaTFvMmQyc3A1MjlmdXoxcmsvc3RhdGljLyIsIm9yaWVudGF0aW9uIjoicG9ydHJhaXQiLCJvcmllbnRhdGlvblZhbHVlIjoiVmVydGljYWwiLCJmaW5pc2giOiJzdHJpY3QiLCJmaW5pc2hWYWx1ZSI6IkNvbiBCb3JkZSIsInBvc3RlclNpemUiOiI1IiwicG9zdGVyaWQiOjUsImJvdW5kcyI6eyJfc3ciOnsibG5nIjotMy43NjgwMTY0NjYwNjE5LCJsYXQiOjQwLjMxOTMzNTI2OTg2Mn0sIl9uZSI6eyJsbmciOi0zLjY0NjgyMzUzMzkzNTMsImxhdCI6NDAuNDcyODE3MjY0Nzg5fX0sInpvb20iOjEyLjEyNDcxMTQwMTc5OCwicGl0Y2giOjAsImJlYXJpbmciOjAsInZlcnNpb24iOiJWMiJ9', 1, '39.99', 1, '1_1514199732.pdf'),
(2, 45.72, 30.48, '2_1514199753.jpg', '', 'Madrid', '40.39°N / -3.70°W', 'Spain', '2017-12-25 10:58:38', '43.228.96.48', '2017-12-25 11:02:38', '', 'eyJjb3VudHJ5IjoiVW5pdGVkIFN0YXRlcyIsImNvdW50cnlDb2RlIjoidXMiLCJsYXRpdHVkZSI6NDAuMzk2MTIwMDAwMDIyLCJsb25naXR1ZGUiOi0zLjcwNzQxOTk5OTk4NzYsInBvc3RlclN0eWxlIjoiY2xlYW4iLCJwb3N0ZXJTdHlsZVZhbHVlIjoiQ2xlYW4iLCJtYXBTdHlsZSI6Im1hcGJveDovL3N0eWxlcy90cmF2ZWxtYXBzL2NqOXMzYzFnaTFvMmQyc3A1MjlmdXoxcmsiLCJzdGF0aWNBUEkiOiJodHRwczovL2FwaS5tYXBib3guY29tL3N0eWxlcy92MS90cmF2ZWxtYXBzL2NqOXMzYzFnaTFvMmQyc3A1MjlmdXoxcmsvc3RhdGljLyIsIm9yaWVudGF0aW9uIjoibGFuZHNjYXBlIiwib3JpZW50YXRpb25WYWx1ZSI6Ikhvcml6b250YWwiLCJmaW5pc2giOiJzdHJpY3QiLCJmaW5pc2hWYWx1ZSI6IkNvbiBCb3JkZSIsInBvc3RlclNpemUiOiI1IiwicG9zdGVyaWQiOjUsImJvdW5kcyI6eyJfc3ciOnsibG5nIjotMy43NjgwMTY0NjYwNjE5LCJsYXQiOjQwLjMxOTMzNTI2OTg2Mn0sIl9uZSI6eyJsbmciOi0zLjY0NjgyMzUzMzkzNTMsImxhdCI6NDAuNDcyODE3MjY0Nzg5fX0sInpvb20iOjExLjUzOTE4NTIzODIyOSwicGl0Y2giOjAsImJlYXJpbmciOjAsInZlcnNpb24iOiJWMiJ9', 1, '39.99', 1, '2_1514199745.pdf'),
(3, 60.96, 45.72, '3_1514206184.jpg', '', 'Madrid', '40.42°N / -3.69°W ', 'Spain', '2017-12-25 12:21:54', '43.228.96.48', '2017-12-25 12:49:49', '', 'eyJjb3VudHJ5IjoiVW5pdGVkIFN0YXRlcyIsImNvdW50cnlDb2RlIjoidXMiLCJsYXRpdHVkZSI6NDAuNDE4ODg5OTk5OTkzLCJsb25naXR1ZGUiOi0zLjY5MTkzOTk5OTk5ODUsInBvc3RlclN0eWxlIjoiY2xlYW4iLCJwb3N0ZXJTdHlsZVZhbHVlIjoiQ2xlYW4iLCJtYXBTdHlsZSI6Im1hcGJveDovL3N0eWxlcy90cmF2ZWxtYXBzL2NqOXMzYzFnaTFvMmQyc3A1MjlmdXoxcmsiLCJzdGF0aWNBUEkiOiJodHRwczovL2FwaS5tYXBib3guY29tL3N0eWxlcy92MS90cmF2ZWxtYXBzL2NqOXMzYzFnaTFvMmQyc3A1MjlmdXoxcmsvc3RhdGljLyIsIm9yaWVudGF0aW9uIjoicG9ydHJhaXQiLCJvcmllbnRhdGlvblZhbHVlIjoiVmVydGljYWwiLCJmaW5pc2giOiJzdHJpY3QiLCJmaW5pc2hWYWx1ZSI6IkNvbiBCb3JkZSIsInBvc3RlclNpemUiOiI2IiwicG9zdGVyaWQiOjYsImJvdW5kcyI6eyJfc3ciOnsibG5nIjotMy43NTI1MzY0NjYwNjI0LCJsYXQiOjQwLjM1MDc2NjA0NDc3OX0sIl9uZSI6eyJsbmciOi0zLjYzMTM0MzUzMzkzNDQsImxhdCI6NDAuNDg2OTQ1MDQzNzkyfX0sInpvb20iOjEyLjI5Njc4ODUzMjYzLCJwaXRjaCI6MCwiYmVhcmluZyI6MCwidmVyc2lvbiI6IlYyIn0=', 1, '43.00', 2, '3_1514206176.pdf'),
(4, 60.96, 45.72, '4_1514206197.jpg', '', 'Madrid', '40.39°N / -3.70°W', 'Spain', '2017-12-25 12:21:54', '43.228.96.48', '2017-12-25 12:50:02', '', 'eyJjb3VudHJ5IjoiVW5pdGVkIFN0YXRlcyIsImNvdW50cnlDb2RlIjoidXMiLCJsYXRpdHVkZSI6NDAuMzk2MTIwMDAwMDM4LCJsb25naXR1ZGUiOi0zLjcwNzQxOTk5OTk5NzIsInBvc3RlclN0eWxlIjoiY2xlYW4iLCJwb3N0ZXJTdHlsZVZhbHVlIjoiQ2xlYW4iLCJtYXBTdHlsZSI6Im1hcGJveDovL3N0eWxlcy90cmF2ZWxtYXBzL2NqOXMzYzFnaTFvMmQyc3A1MjlmdXoxcmsiLCJzdGF0aWNBUEkiOiJodHRwczovL2FwaS5tYXBib3guY29tL3N0eWxlcy92MS90cmF2ZWxtYXBzL2NqOXMzYzFnaTFvMmQyc3A1MjlmdXoxcmsvc3RhdGljLyIsIm9yaWVudGF0aW9uIjoibGFuZHNjYXBlIiwib3JpZW50YXRpb25WYWx1ZSI6Ikhvcml6b250YWwiLCJmaW5pc2giOiJzdHJpY3QiLCJmaW5pc2hWYWx1ZSI6IkNvbiBCb3JkZSIsInBvc3RlclNpemUiOiI2IiwicG9zdGVyaWQiOjYsImJvdW5kcyI6eyJfc3ciOnsibG5nIjotMy43NjgwMTY0NjYwNzc5LCJsYXQiOjQwLjMyNzk3MzAwOTc0NX0sIl9uZSI6eyJsbmciOi0zLjY0NjgyMzUzMzk0OTksImxhdCI6NDAuNDY0MTk4MDg3Njk2fX0sInpvb20iOjExLjg4MTc1MTAzMzM1MSwicGl0Y2giOjAsImJlYXJpbmciOjAsInZlcnNpb24iOiJWMiJ9', 1, '43.00', 2, '4_1514206189.pdf'),
(5, 91.44, 60.96, '5_1514206544.jpg', '', 'Madrid', '40.39°N / -3.70°W', 'Spain', '2017-12-25 12:28:00', '43.228.96.48', '2017-12-25 12:55:50', '', 'eyJjb3VudHJ5IjoiVW5pdGVkIFN0YXRlcyIsImNvdW50cnlDb2RlIjoidXMiLCJsYXRpdHVkZSI6NDAuMzk2MTIwMDAwMDEyLCJsb25naXR1ZGUiOi0zLjcwNzQyMDAwMDAwNzEsInBvc3RlclN0eWxlIjoiY2xlYW4iLCJwb3N0ZXJTdHlsZVZhbHVlIjoiQ2xlYW4iLCJtYXBTdHlsZSI6Im1hcGJveDovL3N0eWxlcy90cmF2ZWxtYXBzL2NqOXMzYzFnaTFvMmQyc3A1MjlmdXoxcmsiLCJzdGF0aWNBUEkiOiJodHRwczovL2FwaS5tYXBib3guY29tL3N0eWxlcy92MS90cmF2ZWxtYXBzL2NqOXMzYzFnaTFvMmQyc3A1MjlmdXoxcmsvc3RhdGljLyIsIm9yaWVudGF0aW9uIjoicG9ydHJhaXQiLCJvcmllbnRhdGlvblZhbHVlIjoiVmVydGljYWwiLCJmaW5pc2giOiJzdHJpY3QiLCJmaW5pc2hWYWx1ZSI6IkNvbiBCb3JkZSIsInBvc3RlclNpemUiOiI3IiwicG9zdGVyaWQiOjcsImJvdW5kcyI6eyJfc3ciOnsibG5nIjotMy43NjgwMTY0NjYwNjE5LCJsYXQiOjQwLjMxOTMzNTI2OTg2Mn0sIl9uZSI6eyJsbmciOi0zLjY0NjgyMzUzMzkzNTMsImxhdCI6NDAuNDcyODE3MjY0Nzg5fX0sInpvb20iOjEyLjEyNDcxMTQwMTc5OCwicGl0Y2giOjAsImJlYXJpbmciOjAsInZlcnNpb24iOiJWMiJ9', 1, '57.00', 3, '5_1514206535.pdf'),
(6, 91.44, 60.96, '6_1514206558.jpg', '', 'Madrid', '40.39°N / -3.70°W', 'Spain', '2017-12-25 12:28:00', '43.228.96.48', '2017-12-25 12:56:03', '', 'eyJjb3VudHJ5IjoiVW5pdGVkIFN0YXRlcyIsImNvdW50cnlDb2RlIjoidXMiLCJsYXRpdHVkZSI6NDAuMzk2MTIwMDAwMDIyLCJsb25naXR1ZGUiOi0zLjcwNzQxOTk5OTk4NzYsInBvc3RlclN0eWxlIjoiY2xlYW4iLCJwb3N0ZXJTdHlsZVZhbHVlIjoiQ2xlYW4iLCJtYXBTdHlsZSI6Im1hcGJveDovL3N0eWxlcy90cmF2ZWxtYXBzL2NqOXMzYzFnaTFvMmQyc3A1MjlmdXoxcmsiLCJzdGF0aWNBUEkiOiJodHRwczovL2FwaS5tYXBib3guY29tL3N0eWxlcy92MS90cmF2ZWxtYXBzL2NqOXMzYzFnaTFvMmQyc3A1MjlmdXoxcmsvc3RhdGljLyIsIm9yaWVudGF0aW9uIjoibGFuZHNjYXBlIiwib3JpZW50YXRpb25WYWx1ZSI6Ikhvcml6b250YWwiLCJmaW5pc2giOiJzdHJpY3QiLCJmaW5pc2hWYWx1ZSI6IkNvbiBCb3JkZSIsInBvc3RlclNpemUiOiI3IiwicG9zdGVyaWQiOjcsImJvdW5kcyI6eyJfc3ciOnsibG5nIjotMy43NjgwMTY0NjYwNjE5LCJsYXQiOjQwLjMxOTMzNTI2OTg2Mn0sIl9uZSI6eyJsbmciOi0zLjY0NjgyMzUzMzkzNTMsImxhdCI6NDAuNDcyODE3MjY0Nzg5fX0sInpvb20iOjExLjUzOTE4NTIzODIyOSwicGl0Y2giOjAsImJlYXJpbmciOjAsInZlcnNpb24iOiJWMiJ9', 1, '57.00', 3, '6_1514206550.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `map_order`
--

CREATE TABLE `map_order` (
  `order_id` int(11) NOT NULL,
  `orderid` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `discount` decimal(5,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `address_line1` varchar(255) NOT NULL,
  `address_line2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `transactionid` varchar(50) NOT NULL,
  `status` enum('Pending','Accepted','Submitted','Finish','Canceled') NOT NULL DEFAULT 'Pending',
  `printmotorsubmission` tinyint(1) NOT NULL,
  `printmotorid` varchar(20) DEFAULT NULL,
  `created_datetime` datetime NOT NULL,
  `created_ip` varchar(61) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_ip` varchar(61) NOT NULL,
  `estimate_delivery_date` datetime DEFAULT NULL,
  `tracking_code` varchar(50) DEFAULT NULL,
  `processing_status` text,
  `post_class` varchar(50) DEFAULT NULL,
  `printmotor_error` text,
  `invoice_file` varchar(50) DEFAULT NULL,
  `coupon_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `map_order`
--

INSERT INTO `map_order` (`order_id`, `orderid`, `name`, `email`, `phone`, `total_amount`, `discount`, `subtotal`, `address_line1`, `address_line2`, `city`, `state`, `country`, `zipcode`, `transactionid`, `status`, `printmotorsubmission`, `printmotorid`, `created_datetime`, `created_ip`, `modified_date`, `modified_ip`, `estimate_delivery_date`, `tracking_code`, `processing_status`, `post_class`, `printmotor_error`, `invoice_file`, `coupon_code`) VALUES
(1, '20171225105838663', 'KATHAK DABHI', 'kathak@mxicoders.com', '7698294508', '79.98', '0.00', '79.98', '910 Akshat Tower', 'SG Highway', 'Ahmedabad', 'CA', 'US', '2563890', 'ch_1BcsjDEbhQ9gjhTl5fI8uyoR', 'Accepted', 0, NULL, '2017-12-25 10:58:38', '43.228.96.48', '2017-12-25 11:02:38', '', NULL, NULL, NULL, NULL, NULL, '1_1514195920.pdf', ''),
(2, '20171225122154660', 'KATHAK DABHI', 'kathak@mxicoders.com', '7698294508', '86.00', '0.00', '86.00', '910 Akshat Tower', 'SG High Way', 'Ahmedabad', 'CA', 'US', '12365890', 'ch_1Bcu1nEbhQ9gjhTlPqufLrCv', 'Accepted', 0, NULL, '2017-12-25 12:21:54', '43.228.96.48', '2017-12-25 12:50:02', '', NULL, NULL, NULL, NULL, 'Recipient: Shipping address state and ZIP code don\'t match. Enter the correct state or ZIP code.', '2_1514200916.pdf', ''),
(3, '20171225122800956', 'KATHAK DABHI', 'kathak@mxicoders.com', '7698294508', '114.00', '0.00', '114.00', '910 Akshat Tower', 'SG Highway', 'Ahmedabad', 'CA', 'US', '1256328', 'ch_1Bcu7hEbhQ9gjhTlSnkMuBbP', 'Accepted', 0, NULL, '2017-12-25 12:28:00', '43.228.96.48', '2017-12-25 12:56:03', '', NULL, NULL, NULL, NULL, 'Recipient: Shipping address state and ZIP code don\'t match. Enter the correct state or ZIP code.', '3_1514201281.pdf', '');

-- --------------------------------------------------------

--
-- Table structure for table `map_pages`
--

CREATE TABLE `map_pages` (
  `pageid` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_description` text NOT NULL,
  `short_desc` text NOT NULL,
  `description` text NOT NULL,
  `status` enum('Enable','Disable') NOT NULL,
  `edit_date` datetime NOT NULL,
  `edit_ip` varchar(100) NOT NULL,
  `edit_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `map_pages`
--

INSERT INTO `map_pages` (`pageid`, `page_title`, `meta_title`, `meta_keyword`, `meta_description`, `short_desc`, `description`, `status`, `edit_date`, `edit_ip`, `edit_by`) VALUES
(1, 'Home', 'myjourneymap', 'myjourneymap', 'myjourneymap', 'Beautifully designed maps by us.\r\nCustom created by you!', '<p>\r\n	<!-- End header --></p>\r\n<section class="gray">\r\n	<div class="container">\r\n		<div class="row">\r\n			<div class="white">\r\n				<div class="col-md-12 padding-0">\r\n					<div class="col-md-3 col-xs-12 cc">\r\n						<img alt="" class="img-responsive center-img" src="/img/location.png" style="width: 148px; height: 148px;" title="" />\r\n						<p class="design-title">\r\n							Your Location</p>\r\n					</div>\r\n					<div class="col-md-1 col-xs-12 cs-class-first">\r\n						<img alt="" class="img-responsive vv center-img" src="/img/right-arrow.png" style="margin-top:-15px;" title="" /></div>\r\n					<div class="col-md-1 col-xs-12 cs-class-second">\r\n						<img alt="" class="img-responsive vv1 center-img" src="/img/right-arrow1.png" style="width: 74px; height: 41px;" title="" /></div>\r\n					<div class="col-md-3 col-xs-12 cc">\r\n						<img alt="" class="img-responsive center-img" src="/img/create-design.png" style="width: 148px; height: 148px;" title="" />\r\n						<p class="design-title">\r\n							Create Design</p>\r\n					</div>\r\n					<div class="col-md-1 col-xs-12 cs-class-first">\r\n						<img alt="" class="img-responsive vv center-img" src="/img/right-arrow.png" style="margin-top:-15px;" title="" /></div>\r\n					<div class="col-md-1 col-xs-12 cs-class-second">\r\n						<img alt="" class="img-responsive vv1 center-img" src="/img/right-arrow1.png" style="width: 74px; height: 41px;" title="" /></div>\r\n					<div class="col-md-3 col-xs-12 cc">\r\n						<img alt="" class="img-responsive center-img" src="/img/print.png" style="width: 148px; height: 148px;" title="" />\r\n						<p class="design-title">\r\n							Get Quality Print</p>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n	<div class="container">\r\n		<div class="row">\r\n			<h1 style="margin-left: 480px;">\r\n				What We Do</h1>\r\n			<h2>\r\n				<span style="font-size:12pt;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">My Journey Map offers a unique way to remember the travels that are most important to you. &nbsp;We all travel for different reasons, but no matter why, the experiences we gain along the way are invaluable. &nbsp;Create your own stunningly beautiful Journey Map in print as a unique way of keeping those memories alive.</span></h2>\r\n		</div>\r\n	</div>\r\n	<section class="gray">\r\n		<figure class="snip1321 col-md-3 col-xs-6 padding-0">\r\n			<p>\r\n				&nbsp;</p>\r\n		</figure>\r\n		<figure class="snip1321 col-md-3 col-xs-6 padding-0">\r\n			<p>\r\n				&nbsp;</p>\r\n		</figure>\r\n		<figure class="snip1321 col-md-3 col-xs-6 padding-0">\r\n			<p>\r\n				&nbsp;</p>\r\n		</figure>\r\n		<figure class="snip1321 col-md-3 col-xs-6 padding-0">\r\n			<p>\r\n				&nbsp;</p>\r\n		</figure>\r\n		<figure class="snip1321 col-md-3 col-xs-6 padding-0">\r\n			<p>\r\n				&nbsp;</p>\r\n		</figure>\r\n		<figure class="snip1321 col-md-3 col-xs-6 padding-0">\r\n			<p>\r\n				&nbsp;</p>\r\n		</figure>\r\n		<figure class="snip1321 col-md-3 col-xs-6 padding-0">\r\n			<p>\r\n				&nbsp;</p>\r\n		</figure>\r\n		<figure class="snip1321 col-md-3 col-xs-6 padding-0">\r\n			<p>\r\n				&nbsp;</p>\r\n		</figure>\r\n	</section>\r\n	<section>\r\n		<div class="service">\r\n			<div class="container">\r\n				<div class="row">\r\n					<div class="col-xs-12">\r\n						<h1 style="margin-left: 520px;">\r\n							<span style="color:#ffa500;">Why Us</span></h1>\r\n						<p dir="ltr" id="docs-internal-guid-2ac880bc-0d48-dc48-04fd-0e84dde7cfa4" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\r\n							<span style="font-size: 12pt; font-family: Arial; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline;">My Journey Map only uses museum-quality posters made on thick, durable, matte paper. &nbsp;Our paper weight is 193 gsm, fingerprint resistant and acid-free. Perfect for framing, your poster will be the conversation piece in any room.</span></p>\r\n						<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\r\n							<span style="font-size: 12pt; font-family: Arial; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline;">(Did we mention free anywhere on the planet?)</span></p>\r\n						<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\r\n							&nbsp;</p>\r\n						<a class="start-here" href="/editor" title="CONTINUE">CONTINUE</a></div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n</section>\r\n<p>\r\n	&nbsp;</p>\r\n', 'Enable', '0000-00-00 00:00:00', '', 0),
(2, 'About Us', 'About Us', 'About Us', 'About Us', '', '<h3 style="margin-top: 0px; margin-bottom: 0px; font-family: DauphinPlain; font-size: 36px; line-height: 90px; color: rgb(0, 0, 0); text-align: left;">\r\n	<span style="font-family:trebuchet ms,helvetica,sans-serif;"><img alt="" class="img-responsive" src="/img/design.png" /></span></h3>\r\n<hr />\r\n<div font-size:="" id="Content" open="" style="position: relative; color: rgb(0, 0, 0); font-family: " text-align:="">\r\n	<blockquote>\r\n		<h1 dir="ltr" id="docs-internal-guid-2ac880bc-0d4a-eb10-7f01-50ed99bfd51b" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt; margin-left: 480px;">\r\n			<span style="font-family:trebuchet ms,helvetica,sans-serif;"><span style="font-size: 28px;">What is My Journey Maps?</span></span></h1>\r\n		<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\r\n			&nbsp;</p>\r\n		<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\r\n			<span style="font-family:trebuchet ms,helvetica,sans-serif;"><span style="font-size: 12pt; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline;">My Journey Maps is a design studio used to create your own personalized souvenir poster of your travels. &nbsp;Use our simple, easy-to-use technology to create a poster based on any location on the planet. </span></span></p>\r\n		<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\r\n			&nbsp;</p>\r\n		<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\r\n			<span style="font-family:trebuchet ms,helvetica,sans-serif;"><span style="font-size: 12pt; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline;">Have a favorite city or special place that you want to be reminded of and relive? Let us help you create a lasting memory that will be a topic of conversation for years to come.</span></span></p>\r\n	</blockquote>\r\n	<hr />\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		&nbsp;</p>\r\n	<h2 dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;">\r\n		<span style="font-family:trebuchet ms,helvetica,sans-serif;"><span style="font-size: 12pt; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline;"><img src="https://lh5.googleusercontent.com/YQNR6n7GDzFpt2uoyiwlmYBcxrAXtWXsgC48WXdX8KKG8Iz2mGTCpQsaQvUzh_BvnFGJYLMsye_ZcQJPYA5oV8pZ9MuT9ehv257frh3VGfZ6oSUW8-6b9QgkSsTdHIeixScq52HA" style="border: 3px solid; transform: rotate(0rad); width: 516px; height: 280px; float: left; margin: 0px 30px;" /></span><span style="font-size: 28px;">Our Journey</span></span></h2>\r\n	<p>\r\n		<span style="font-family:trebuchet ms,helvetica,sans-serif;"><span style="font-size: 16px;"><span style="color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline;">We&rsquo;re Travelers.</span></span></span></p>\r\n	<p>\r\n		<span style="font-family:trebuchet ms,helvetica,sans-serif;"><span style="font-size: 12pt; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline;">Like any great story, this one begins with a motorcycle.</span></span></p>\r\n	<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\r\n		<span style="font-family:trebuchet ms,helvetica,sans-serif;"><span style="font-size: 12pt; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline;">In 2013 I decided to quit my job, sell all of my belongings, and set out in search of adventure. &nbsp;Today- and many countries, planes, trains, buses, cars, bikes, and hikes later- I&#39;m still searching.&nbsp; </span></span></p>\r\n	<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\r\n		&nbsp;</p>\r\n	<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\r\n		<span style="font-family:trebuchet ms,helvetica,sans-serif;"><span style="font-size: 12pt; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline;">While exchanging stories with other travelers, they pulled out their map to show where they had been. &nbsp;With each spot marked on their map, a funny, or thrilling memory was re-lived. &nbsp;With this as inspiration, and with the help of a few beers, My Journey Map was created.</span></span></p>\r\n	<br />\r\n	<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\r\n		&nbsp;</p>\r\n	<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\r\n		<span style="font-family:trebuchet ms,helvetica,sans-serif;"><span style="font-size: 12pt; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline;"><img alt="about us photo.jpg" src="https://lh4.googleusercontent.com/WGWFZJDoLOaCAgFOI2DeVEBcyrdSZCQqQvw0hRvhTvO53diCFDrutm7f5oVCl5M7-zYqCD_McRkJMlClS7DAUaITtv0R_nixwmY6XSqUqXJAdF8sZFFmXlee2XT__NakvHX-1mDj" style="border: 3px solid; transform: rotate(0rad); width: 516px; height: 280px; float: right; margin: 0px 30px;" /></span><span style="font-size: 12pt; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline;">While traveling through Europe, I met Harrison in Prague. &nbsp;We both had similar aspirations and goals, not to mention an affinity for great beer. &nbsp;Almost a year later, we both found ourselves living in Queenstown, New Zealand</span><span style="font-size: 12pt; color: rgb(0, 255, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline;">,</span><span style="font-size: 12pt; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline;"> and we decided to launch My Journey Maps </span><span style="font-size: 12pt; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline;">together.</span></span></p>\r\n	<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\r\n		&nbsp;</p>\r\n	<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\r\n		<span style="font-family:trebuchet ms,helvetica,sans-serif;"><span style="font-size: 12pt; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline;">Get the most out of your travels. &nbsp;Relive your journey, whether it&#39;s a solo adventure, family holiday, honeymoon, or a trip to be treasured for your own remarkable reasons. &nbsp;We can help you create a beautiful work of art that will keep those memories alive for years. &nbsp;Create your My Map Journey today.</span></span></p>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', 'Enable', '2015-10-08 03:38:48', '5.148.139.99', 0),
(3, 'Contact US', 'Contact Us', 'Contact Us', 'Contact Us', '', '', '', '0000-00-00 00:00:00', '', 0),
(4, 'Servicies', 'Services', 'Services', 'Services', '', '<h1 dir="ltr" id="docs-internal-guid-0f65b45c-c2b7-a92f-b31a-be6922cf8f84" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;">\r\n	<span style="font-family:trebuchet ms,helvetica,sans-serif;"><strong><span style="font-size:18px;"><span style="color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: underline; vertical-align: baseline;">Services</span></span></strong></span></h1>\r\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\r\n	&nbsp;</p>\r\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\r\n	<span style="font-family:trebuchet ms,helvetica,sans-serif;"><span style="font-size: 12pt; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline;">Use My Journey Map online editor to create custom maps for print and ship anywhere on the planet.&nbsp; </span></span></p>\r\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\r\n	&nbsp;</p>\r\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\r\n	<span style="font-family:trebuchet ms,helvetica,sans-serif;"><span style="font-size: 12pt; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline;">Creating your very own Journey Map is more than a gift to yourself or that wanderer in your life. &nbsp;My Journey Maps is a way to capture the spirit and memory of the moment. &nbsp;We all have places that are special and personal, let us create a unique way to help cherish those memories. &nbsp;Create your own stunningly beautiful Journey Map in print as a unique way of keeping those memories alive.</span></span></p>\r\n<br />\r\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\r\n	<span style="font-family:trebuchet ms,helvetica,sans-serif;"><span style="font-size: 12pt; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline;">Are you looking to surprise someone else? &nbsp;An online gift card makes a special gift for any occasion. &nbsp;</span></span></p>\r\n<h1>\r\n	<strong><span style="font-size:18px;"><span style="font-family: trebuchet ms,helvetica,sans-serif;"><span style="color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline;">Why us?</span></span></span></strong></h1>\r\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\r\n	<span style="font-family:trebuchet ms,helvetica,sans-serif;"><span style="font-size: 12pt; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline;">My Journey Map only uses museum-quality posters made on thick, durable, matte paper. &nbsp;Our paper weight is 193 gsm, fingerprint resistant and acid-free. Perfect for framing, your poster will be the conversation piece in any room for years to come.</span></span></p>\r\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\r\n	<span style="font-family:trebuchet ms,helvetica,sans-serif;"><span style="font-size: 12pt; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline;">(Did we mention free anywhere on the planet?)</span></span></p>\r\n', 'Enable', '2015-04-23 13:10:05', '127.0.0.1', 0),
(6, 'Showcase', 'Some of the posters created in MyJourneyMap', 'map samples', 'Some of the posters created in MyJourneyMap', '', '<p class="showcase-title">\r\n	<em><strong><span style="font-size:22px;"><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; background-color: rgb(255, 255, 255);">Some of the posters created in MyJourneyMap</span></span></strong></em></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n', 'Enable', '2015-04-23 13:10:37', '127.0.0.1', 0),
(7, 'Editor', 'My Journey Map', 'MyJourneyMap', '', '', '', '', '0000-00-00 00:00:00', '', 0),
(8, 'Terns and conditions', 'Terms and conditions', 'Terms and conditions', 'Terms and conditions', '', '<h3 style="margin-top: 0px; margin-bottom: 0px; font-family: DauphinPlain; font-size: 36px; line-height: 90px; color: rgb(0, 0, 0); text-align: center;">\r\n	Terminos y Condiciones</h3>\r\n<h4 open="" style="margin-right: 10px; margin-bottom: 5px; margin-left: 10px; text-align: center; line-height: 18px; font-size: 14px; font-style: italic; color: rgb(0, 0, 0); font-family: ">\r\n	&nbsp;</h4>\r\n<hr font-size:="" open="" style="margin-top: 0px; margin-bottom: 0px; clear: both; border-top: 0px; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.74902), rgba(0, 0, 0, 0)); color: rgb(0, 0, 0); font-family: " text-align:="" />\r\n<div font-size:="" id="Content" open="" style="position: relative; color: rgb(0, 0, 0); font-family: " text-align:="">\r\n	<div class="boxed" style="margin: 10px 28.7969px; clear: both;">\r\n		<div id="lipsum" style="text-align: justify;">\r\n			<p style="margin-bottom: 15px;">\r\n				&nbsp;</p>\r\n			<p>\r\n				Los siguientes t&eacute;rminos y condiciones (el &quot;Acuerdo&quot;) rigen todo uso del sitio web mapify.es (el &quot;Sitio&quot;) y los servicios disponibles en o en el Sitio. Mapify imprime y env&iacute;a mapas personalizados ( &quot;Productos&quot;) directamente a clientes ( &quot;clientes&quot;). El Servicio se ofrece sujeto a su aceptaci&oacute;n (el &quot;Usuario&quot;) sin la modificaci&oacute;n de todos los t&eacute;rminos y condiciones contenidos en este documento y todas las dem&aacute;s reglas operativas, pol&iacute;ticas y procedimientos que pueden ser publicados de vez en cuando en el Sitio por Mapify. Si no est&aacute; de acuerdo con este Acuerdo, no use el Sitio.</p>\r\n			<p>\r\n				&nbsp;</p>\r\n			<p>\r\n				<strong>1 Clientes </strong><br />\r\n				<br />\r\n				1.1 El Cliente certifica a Mapify que si el Cliente es un individuo (es decir, no una empresa), el Cliente tiene por lo menos 18 a&ntilde;os de edad. El Cliente tambi&eacute;n certifica que est&aacute; legalmente autorizado a utilizar el Servicio y asume la plena responsabilidad de la selecci&oacute;n y uso del Servicio. Este Acuerdo es nulo donde lo proh&iacute;ba la ley, y el derecho de acceso al Servicio es revocado en dichas jurisdicciones.</p>\r\n			<p>\r\n				<br />\r\n				<br />\r\n				<strong>2 Modificaciones </strong><br />\r\n				<br />\r\n				2.1 Mapify se reserva el derecho, a su discreci&oacute;n, de modificar este Acuerdo, tarifas, cargos y condiciones en cualquier momento. El Usuario ser&aacute; responsable de revisar y familiarizarse con dichas modificaciones. El uso del Servicio por parte del Usuario despu&eacute;s de dicha notificaci&oacute;n constituye la aceptaci&oacute;n por el Usuario de los t&eacute;rminos y condiciones de los cambios modificados.<br />\r\n				<br />\r\n				<br />\r\n				<strong>3 Responsabilidad de los clientes y visitantes del sitio </strong><br />\r\n				<br />\r\n				3.1 La infracci&oacute;n de cualquier art&iacute;culo de este Acuerdo u otras reglas prohibir&aacute; a los Usuarios el uso del Sitio.<br />\r\n				<br />\r\n				3.2 Sin limitar otros recursos, podemos limitar, suspender o terminar nuestro Servicio, prohibir el acceso a nuestro Sitio, retrasar o eliminar el Contenido hospedado, y tomar medidas t&eacute;cnicas y legales para mantener a los Usuarios fuera del Sitio si creemos que est&aacute;n creando problemas, posibles Responsabilidades legales o actuar de manera inconsistente con el texto de nuestras pol&iacute;ticas.</p>\r\n			<p>\r\n				&nbsp;</p>\r\n			<p>\r\n				<br />\r\n				<strong>4 Pagos y tasas </strong><br />\r\n				<br />\r\n				4.1 Mapify NO guarda la informaci&oacute;n de la tarjeta de cr&eacute;dito o d&eacute;bito de los Usuarios. Cuando usted pide un Producto, se le cobrar&aacute;n los cargos actuales, que podemos cambiar de vez en cuando (por ejemplo, cuando tenemos descuento del precio del producto base). Podemos optar por cambiar temporalmente los precios de nuestros Productos y siempre estar&aacute;n disponibles en nuestro sitio web.<br />\r\n				<br />\r\n				4.2 Al realizar un pedido a trav&eacute;s del Sitio, usted confirma que tiene legalmente derecho a utilizar los medios de pago ofrecidos y, en el caso de pagos con tarjeta, que es el titular de la tarjeta o tiene el permiso expreso del titular para utilizar la tarjeta Efecto de pago.<br />\r\n				<br />\r\n				4.3 Podemos rehusar procesar una transacci&oacute;n por cualquier raz&oacute;n o rechazar el Servicio a cualquier persona en cualquier momento a nuestra sola discreci&oacute;n. No seremos responsables ante usted o cualquier tercero por raz&oacute;n de rechazar o suspender cualquier transacci&oacute;n despu&eacute;s de que el proceso haya comenzado.<br />\r\n				<br />\r\n				4.4 Salvo que se indique lo contrario, todos los pagos se cotizan en Euros. El Usuario es responsable de pagar todas las tarifas, pagos e impuestos aplicables asociados con nuestro Sitio y Productos. Despu&eacute;s de recibir su pedido, recibir&aacute; un e-mail de nosotros confirmando los detalles, la descripci&oacute;n y el precio de los Productos pedidos.<br />\r\n				<br />\r\n				4.5 El pago del precio total m&aacute;s la entrega debe hacerse en su totalidad antes de la expedici&oacute;n de sus Productos.</p>\r\n			<p>\r\n				&nbsp;</p>\r\n			<p>\r\n				<strong>5 Impuesto de ventas </strong><br />\r\n				<br />\r\n				5.1 Si el cliente se encuentra fuera del territorio de la Uni&oacute;n Europea, el cliente es responsable del pago del impuesto sobre ventas (seg&uacute;n proceda en cada jurisdicci&oacute;n). Mapify no se hace responsable de tal impuesto de venta. Si el cliente se encuentra dentro de la Uni&oacute;n Europea el impuesto de ventas IVA se incluye dentro de ese precio del producto.<br />\r\n				<br />\r\n				5.2 Los clientes fuera de la Uni&oacute;n Europea pueden estar sujetos a derechos de aduana (seg&uacute;n proceda en cada jurisdicci&oacute;n). Mapify no se hace responsable de tales deberes.<br />\r\n				<br />\r\n				6 Env&iacute;o, devoluciones y derecho de retractaci&oacute;n<br />\r\n				6.1 Una vez que haya hecho clic en el bot&oacute;n &quot;comprar&quot;, no es posible editar o cancelar su pedido. Si desea cambiar algunos par&aacute;metros, direcciones de clientes, etc., p&oacute;ngase en contacto con nosotros lo antes posible. No estamos obligados a hacer tales modificaciones en su pedido, pero haremos todo lo posible caso por caso. El reemplazo de productos por productos reclamados como da&ntilde;ados o no recibidos est&aacute;n sujetos a la investigaci&oacute;n y discreci&oacute;n de Mapify.<br />\r\n				<br />\r\n				6.2 Mapify revisar&aacute; las solicitudes de reemplazo / devoluci&oacute;n, si faltan o se ha roto el Producto, o hay un error de impresi&oacute;n o si se trata de un fallo de Mapify. Mapify no es responsable de los nombres, direcciones, etc, por lo que el pago extra ser&aacute; aplicado.<br />\r\n				<br />\r\n				6.3 Debido a la individualizaci&oacute;n del Producto, no hay derecho de cancelaci&oacute;n para el Producto despu&eacute;s de haber hecho el pedido.<br />\r\n				<br />\r\n				7 Descripci&oacute;n de los productos<br />\r\n				7.1 Aunque muchos componentes de nuestros productos son est&aacute;ndar, todos los productos disponibles para la compra se describen en la p&aacute;gina de dise&ntilde;o espec&iacute;fico en nuestro sitio. Siempre tratamos de representar cada dise&ntilde;o con la mayor precisi&oacute;n posible.<br />\r\n				<br />\r\n				7.2 Tenemos una pol&iacute;tica de desarrollo continuo del producto para que podamos ofrecerle lo que consideramos el mejor dise&ntilde;o combinado con el mejor rendimiento y, por tanto, reservamos el derecho de modificar las especificaciones de los Productos, su precio y embalaje sin previo aviso. Antes de hacer su pedido, por lo tanto, le invitamos a echar un vistazo a la descripci&oacute;n del producto y el dise&ntilde;o.<br />\r\n				<br />\r\n				7.3 Hacemos todo lo posible para ofrecerle las mejores im&aacute;genes y descripciones, pero lamentablemente no podemos garantizar que los colores y detalles de las im&aacute;genes del sitio web sean representaciones del Producto 100% exactas.<br />\r\n				<br />\r\n				<br />\r\n				<br />\r\n				<strong>8 Compra de Productos </strong><br />\r\n				<br />\r\n				8.1 Su pedido representa una oferta para comprar un Producto que es aceptado por nosotros una vez que le hemos enviado una confirmaci&oacute;n de pedido por correo electr&oacute;nico. Cualquier Producto en el mismo pedido que no hemos confirmado en un correo electr&oacute;nico de confirmaci&oacute;n de pedido no forma parte de ese contrato.<br />\r\n				<br />\r\n				8.2 Mapify no ser&aacute; en ning&uacute;n caso responsable de las p&eacute;rdidas especiales debidas a circunstancias espec&iacute;ficas del Usuario y / o del Cliente, p&eacute;rdidas indirectas o consecuentes o gastos perdidos.<br />\r\n				<br />\r\n				8.3 Los pedidos se realizan y reciben exclusivamente a trav&eacute;s del Sitio. Antes de hacer su pedido con nosotros, es responsabilidad del Cliente comprobar y determinar la capacidad total para recibir los Productos. La direcci&oacute;n correcta del cliente y el c&oacute;digo postal, el n&uacute;mero de tel&eacute;fono actualizado del usuario y la direcci&oacute;n de correo electr&oacute;nico son absolutamente necesarios para garantizar la entrega correcta de los productos.<br />\r\n				<br />\r\n				8.4 Toda la informaci&oacute;n solicitada en la p&aacute;gina de pago debe rellenarse con precisi&oacute;n y exactitud. Mapify no se hace responsable de la falta de entrega debido a una direcci&oacute;n de entrega equivocada o un n&uacute;mero de tel&eacute;fono inapropiado. Si desea solicitar un cambio en la direcci&oacute;n de entrega comun&iacute;quese con Mapify.<br />\r\n				&nbsp;</p>\r\n			<p>\r\n				<strong>9 Entrega </strong><br />\r\n				<br />\r\n				9.1 Mapify entrega a usuarios / clientes los productos en Espa&ntilde;a y Latino Am&eacute;rica. El precio del env&iacute;o est&aacute; incluido en el precio de venta.<br />\r\n				<br />\r\n				9.2 Mapify no puede garantizar las fechas de entrega y no asume ninguna responsabilidad, aparte de avisarle de cualquier retraso conocido de los Productos que se entregan despu&eacute;s de la fecha de entrega estimada. Los plazos de entrega est&aacute;ndar se muestran en el sitio. Es s&oacute;lo una estimaci&oacute;n promedia, y algunas entregas pueden tomar m&aacute;s tiempo, o, alternativamente, ser entregado mucho m&aacute;s r&aacute;pido. Todas las estimaciones de entrega dados en el momento de hacer el pedido est&aacute;n sujetos a cambios. En cualquier caso, haremos todo lo posible para contactarle y aconsejarle sobre todos los cambios. Nuestro inter&eacute;s es hacer la entrega del producto tan pronto como sea posible.<br />\r\n				<br />\r\n				La propiedad de los Productos s&oacute;lo pasar&aacute; a los Clientes cuando recibamos el pago total de todas las sumas adeudadas con respecto a los Productos.<br />\r\n				<br />\r\n				<br />\r\n				<br />\r\n				<strong>10 Liberaci&oacute;n de responsabilidades </strong><br />\r\n				<br />\r\n				10.1 Usted nos libera (y de nuestros directores, agentes, subsidiarias, empresas conjuntas y empleados) de reclamaciones, demandas y da&ntilde;os (reales y consecuentes) de todo tipo y naturaleza, conocidos y desconocidos, que surjan o est&eacute;n relacionados de alguna manera con Tales disputas.</p>\r\n			<br />\r\n			<strong>11 Datos personales y cookies </strong><br />\r\n			<br />\r\n			11.1 Al aprobar el Acuerdo, el Cliente acepta el uso de cookies en el Sitio. Adem&aacute;s, el Cliente acepta que Mapify almacenar&aacute; y utilizar&aacute; datos personales relevantes sobre el Cliente para entregar el Producto.<br />\r\n			<br />\r\n			<br />\r\n			<br />\r\n			<strong>12 Indemnizaci&oacute;n </strong><br />\r\n			<br />\r\n			12.1 Usted indemnizar&aacute; a Mapify (y sus directores, agentes, subsidiarias, empresas conjuntas y empleados) a salvo de cualquier reclamaci&oacute;n o demanda, incluyendo honorarios razonables de abogados, hechos por cualquier tercero debido o derivado de su incumplimiento de Este Acuerdo, o su violaci&oacute;n de cualquier ley o los derechos de un tercero.<br />\r\n			<br />\r\n			<br />\r\n			<br />\r\n			<strong>13 Derecho y Jurisdicci&oacute;n. </strong><br />\r\n			<br />\r\n			13.1 Si surge una disputa entre usted y Mapify, le recomendamos encarecidamente que primero contacte con nosotros directamente para buscar una resoluci&oacute;n. Consideraremos las peticiones razonables para resolver la disputa mediante procedimientos alternativos de resoluci&oacute;n de conflictos, como la mediaci&oacute;n o el arbitraje, como alternativas al litigio.<br />\r\n			<br />\r\n			13.2 Los contratos para la compra de productos a trav&eacute;s de nuestro sitio y cualquier disputa o reclamo que surja de o en relaci&oacute;n con ellos o su objeto o formaci&oacute;n (incluyendo disputas o reclamaciones no contractuales) debe ser resuelto por un tribunal situado en Espa&ntilde;a.<br />\r\n			<br />\r\n			13.3 Cualquier disputa o reclamo que surja de o en relaci&oacute;n con el Acuerdo o su formaci&oacute;n (incluyendo disputas o reclamaciones no contractuales) estar&aacute; sujeto a la jurisdicci&oacute;n no exclusiva de los tribunales de Espa&ntilde;a.<br />\r\n			<br />\r\n			<br />\r\n			<strong>14 General </strong><br />\r\n			<br />\r\n			14.1 Usted reconoce que tiene todos los permisos necesarios para otorgarnos los datos personales del Cliente para cumplir con este Acuerdo.</div>\r\n	</div>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', 'Enable', '0000-00-00 00:00:00', '', 0),
(9, 'Privacy Policy', 'Privacy Policy', 'Privacy Policy', '', '', '<h1 style="margin-top: 0px; margin-bottom: 0px; font-family: DauphinPlain; font-size: 70px; line-height: 90px; color: rgb(0, 0, 0); text-align: center;">\r\n	Lorem Ipsum</h1>\r\n<h4 style="margin-right: 10px; margin-bottom: 5px; margin-left: 10px; text-align: center; line-height: 18px; font-size: 14px; font-style: italic; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">\r\n	&quot;Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...&quot;</h4>\r\n<h5 style="margin: 5px 10px 20px; text-align: center; font-size: 12px; line-height: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">\r\n	&quot;There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...&quot;</h5>\r\n<hr style="margin-top: 0px; margin-bottom: 0px; clear: both; border-top: 0px; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.74902), rgba(0, 0, 0, 0)); color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: center;" />\r\n<div id="Content" style="position: relative; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: center;">\r\n	<div class="boxed" style="margin: 10px 28.7969px; clear: both;">\r\n		<div id="lipsum" style="text-align: justify;">\r\n			<p style="margin-bottom: 15px;">\r\n				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum mauris arcu, vestibulum vitae quam vel, fermentum egestas lectus. Ut a velit porta, semper justo quis, rutrum orci. Phasellus cursus ligula nec purus faucibus ornare. Duis sollicitudin sollicitudin tortor non hendrerit. In eget sagittis nisl. Nullam ex velit, malesuada sit amet facilisis vel, vestibulum rhoncus augue. Morbi laoreet diam sit amet vehicula scelerisque.</p>\r\n			<p style="margin-bottom: 15px;">\r\n				Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean venenatis viverra malesuada. Duis mattis tincidunt elit, id fringilla tellus ornare eu. Pellentesque dolor felis, efficitur eget interdum quis, lacinia nec nunc. Nulla facilisi. Duis pretium ligula nec blandit finibus. Donec ac libero a ante semper consequat aliquam ac velit. Duis dapibus aliquet massa et placerat. Pellentesque faucibus ligula vel tellus molestie, at faucibus arcu hendrerit. Sed eu mauris a arcu pellentesque imperdiet eu sit amet elit. Integer lacus ligula, malesuada a arcu et, commodo hendrerit eros.</p>\r\n			<p style="margin-bottom: 15px;">\r\n				Nam vitae mollis dolor. Duis semper venenatis velit ac rutrum. Nulla tristique ipsum nec magna condimentum, vitae feugiat neque sodales. Ut ornare eros sit amet lobortis hendrerit. Curabitur auctor erat lacus, sed cursus justo eleifend quis. Curabitur consequat dolor nec mi aliquet mattis. Pellentesque gravida odio neque, ut vulputate sem dictum sit amet. Nam tincidunt nibh in libero gravida ultrices in at nibh. Nunc vel aliquet augue. Nunc sapien ante, cursus sit amet viverra ut, eleifend non ligula. Donec porta purus et egestas laoreet. Vivamus ut metus ullamcorper, lacinia mauris quis, lacinia arcu.</p>\r\n			<p style="margin-bottom: 15px;">\r\n				Vestibulum rhoncus facilisis augue sit amet facilisis. Mauris malesuada massa quis placerat malesuada. Cras ante odio, accumsan nec accumsan non, sagittis in felis. Vestibulum a libero sollicitudin, facilisis arcu eu, vulputate erat. Suspendisse elementum dignissim ante, nec facilisis justo. Phasellus ut elit non ante condimentum posuere ac nec nisi. Praesent turpis eros, tristique ut risus sit amet, maximus fermentum velit. Vivamus porta facilisis vehicula. Nam non magna nibh. Pellentesque at orci vitae mi dapibus sollicitudin et a risus. In sed dolor diam. Sed egestas eleifend nibh, sit amet ullamcorper est venenatis sed. Nam fringilla mollis pretium. Proin venenatis mollis lacus, ut vehicula nibh auctor vitae.</p>\r\n			<p style="margin-bottom: 15px;">\r\n				Donec et arcu finibus, sagittis nisl ac, tempor erat. Morbi sit amet viverra ligula, eget ultricies erat. Sed eget pretium metus. Aliquam nec odio in dolor lacinia gravida ut et lacus. Cras luctus auctor felis vel imperdiet. Proin euismod tempus massa vitae finibus. Aenean efficitur faucibus magna id finibus. Nulla arcu dui, auctor vel elementum vel, suscipit id erat. Morbi id diam condimentum, accumsan metus non, fermentum diam. Duis et metus sit amet erat dictum gravida ut eu risus. Praesent nec est eu dolor vehicula cursus.</p>\r\n		</div>\r\n	</div>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', 'Enable', '0000-00-00 00:00:00', '', 0),
(10, 'FAQ', 'FAQ', 'FAQ', 'FAQ', '', '', '', '0000-00-00 00:00:00', '', 0),
(11, 'Thank You', 'Thank You', 'Thank You', 'Thank You', '', '<p>\r\n	<span style="font-family:trebuchet ms,helvetica,sans-serif;">\r\n	<style type="text/css">\r\n.thankyou {\r\n    color: #1a1a1a;\r\n    font-size: 65px;\r\n    font-weight: bold;\r\n    letter-spacing: 3px;\r\n    text-align: center;\r\n    text-transform: uppercase;\r\n}\r\n.check-icon {\r\n    color: #24b663;\r\n    font-size: 67px;\r\n    font-weight: 600;\r\n    margin-bottom: 28px;\r\n    margin-top: 28px;\r\n    text-align: center;\r\n}\r\n.order-details {\r\n    color: #202020;\r\n    font-size: 22px;\r\n    text-align: center;\r\n	 margin-bottom: 40px;\r\n}\r\n.gray-bg-news{\r\n     background: #ffffff none repeat scroll 0 0;\r\n    border: 1px solid #e0e0e0;\r\n    padding: 12px;\r\n}\r\n.cntr-div {\r\n    display: table;\r\n    float: none;\r\n    margin-left: auto;\r\n    margin-right: auto;\r\n    margin-top: 20px;\r\n}\r\n.gray-bg-news i {\r\n    font-size: 30px;\r\n    padding: 9px 0;\r\n}	</style>\r\n	</span></p>\r\n<div>\r\n	<h1 class="thankyou">\r\n		<span style="font-family:trebuchet ms,helvetica,sans-serif;">Thank You!</span></h1>\r\n	<p class="order-details">\r\n		<span style="font-family:trebuchet ms,helvetica,sans-serif;">Your order has been completed successfully. Your order will take you between 5-8 business days if you live in USA or Canada.&nbsp; It will take between 6-12 business days for international orders.</span></p>\r\n	<div class="gray-bg-news col-md-9 cntr-div">\r\n		<p class="col-md-1">\r\n			<span style="font-family:trebuchet ms,helvetica,sans-serif;"><i class="fa fa-envelope">&nbsp;</i></span></p>\r\n		<p class="col-md-11">\r\n			<span style="font-family:trebuchet ms,helvetica,sans-serif;">We have sent you by email invoice of your purchase. If it does not reach you please check your spam tray</span></p>\r\n	</div>\r\n</div>\r\n<p>\r\n	<span style="font-family:trebuchet ms,helvetica,sans-serif;"><u><u>&nbsp;</u></u></span></p>\r\n', '', '0000-00-00 00:00:00', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `map_poster`
--

CREATE TABLE `map_poster` (
  `poster_id` int(11) NOT NULL,
  `poster_name` varchar(255) NOT NULL,
  `poster_height` float NOT NULL,
  `poster_width` float NOT NULL,
  `poster_price` decimal(10,2) NOT NULL,
  `version` enum('V1','V2') NOT NULL DEFAULT 'V1',
  `status` enum('Enable','Disable') NOT NULL DEFAULT 'Enable',
  `created_datetime` datetime NOT NULL,
  `created_ip` varchar(62) NOT NULL,
  `modified_datetime` datetime NOT NULL,
  `modified_ip` varchar(62) NOT NULL,
  `poster_ratio` enum('4:3','6:4','16:9') NOT NULL DEFAULT '4:3',
  `printmotorid` varchar(50) NOT NULL DEFAULT '--',
  `printmotorid_l` varchar(50) NOT NULL DEFAULT '--',
  `isdefault` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `map_poster`
--

INSERT INTO `map_poster` (`poster_id`, `poster_name`, `poster_height`, `poster_width`, `poster_price`, `version`, `status`, `created_datetime`, `created_ip`, `modified_datetime`, `modified_ip`, `poster_ratio`, `printmotorid`, `printmotorid_l`, `isdefault`) VALUES
(1, 'Extra Large', 40, 30, '39.00', 'V1', 'Enable', '2016-08-11 11:08:26', '::1', '2016-11-16 03:57:03', '83.41.86.148', '4:3', '0', '0', 0),
(2, 'Large', 70, 50, '45.00', 'V1', 'Enable', '2016-08-11 11:08:26', '::1', '2016-11-16 03:56:34', '83.41.86.148', '6:4', '0', '0', 1),
(3, 'A1', 100, 70, '59.00', 'V1', 'Enable', '2016-11-05 05:13:08', '43.228.96.6', '2016-11-17 03:31:05', '83.41.86.148', '4:3', '0', '0', 0),
(4, 'A3', 50, 40, '42.00', 'V1', 'Enable', '2017-02-04 12:11:04', '43.228.96.48', '2017-02-20 09:14:51', '83.40.4.224', '4:3', '0', '0', 0),
(5, 'A4-V2', 45.72, 30.48, '39.99', 'V2', 'Enable', '2017-02-04 12:22:05', '43.228.96.48', '2017-02-06 09:36:23', '88.6.128.132', '4:3', '3876', '3876', 0),
(6, 'A2-V2', 60.96, 45.72, '43.00', 'V2', 'Enable', '2017-02-04 12:23:21', '43.228.96.48', '2017-02-16 07:23:04', '43.228.96.43', '4:3', '1', '1', 0),
(7, 'A1-V2', 91.44, 60.96, '57.00', 'V2', 'Enable', '2017-02-04 12:36:23', '43.228.96.48', '2018-01-19 06:43:37', '84.126.246.164', '4:3', '7', '7', 1);

-- --------------------------------------------------------

--
-- Table structure for table `map_poster_style`
--

CREATE TABLE `map_poster_style` (
  `style_id` int(20) NOT NULL,
  `style_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `style_value` varchar(50) NOT NULL,
  `status` enum('Enable','Disable') CHARACTER SET latin1 NOT NULL DEFAULT 'Enable',
  `isdefault` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `map_poster_style`
--

INSERT INTO `map_poster_style` (`style_id`, `style_name`, `style_value`, `status`, `isdefault`) VALUES
(1, 'clean', 'Clean', 'Enable', 0),
(2, 'whitetext', 'Whitetext', 'Enable', 0),
(3, 'modern', 'Modern', 'Enable', 1),
(4, 'stricts', 'Stricts', 'Enable', 0);

-- --------------------------------------------------------

--
-- Table structure for table `map_sem`
--

CREATE TABLE `map_sem` (
  `sem_id` int(20) NOT NULL,
  `field_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `field_value` text CHARACTER SET latin1 NOT NULL,
  `status` enum('Enable','Disable') CHARACTER SET latin1 NOT NULL DEFAULT 'Enable'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `map_sem`
--

INSERT INTO `map_sem` (`sem_id`, `field_name`, `field_value`, `status`) VALUES
(1, 'Facebook', 'https://www.facebook.com', 'Enable'),
(2, 'Twitter', 'https://twitter.com', 'Enable'),
(3, 'Google Plus', 'https://plus.google.com/', 'Enable'),
(4, 'Pinterest', 'https://in.pinterest.com/', 'Disable'),
(5, 'Instagram', 'https://www.instagram.com/', 'Disable'),
(6, 'Linkedin', 'https://www.linkedin.com/', 'Enable');

-- --------------------------------------------------------

--
-- Table structure for table `map_seo`
--

CREATE TABLE `map_seo` (
  `seo_id` bigint(21) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `field_value` text,
  `status` enum('Enable','Disable') NOT NULL DEFAULT 'Enable'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `map_seo`
--

INSERT INTO `map_seo` (`seo_id`, `field_name`, `field_value`, `status`) VALUES
(1, 'Google Analitics', '<script>\r\nalert(\'THis is webmaster script\');\r\n</script>', 'Disable'),
(2, 'Web Master', '<script>\r\nalert(\'THis is webmaster script\');\r\n</script>', 'Disable');

-- --------------------------------------------------------

--
-- Table structure for table `map_setting`
--

CREATE TABLE `map_setting` (
  `setting_id` int(11) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `field_value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `map_setting`
--

INSERT INTO `map_setting` (`setting_id`, `field_name`, `field_value`) VALUES
(1, 'Website Name', 'myjourneymap'),
(2, 'Contact Email', 'support@myjourneymap.net'),
(3, 'contact Number', '6788990435'),
(4, 'Owner Name', 'Myjourneymap'),
(5, 'Location', 'MyJourneyMap\r\n1633 Joan Drive\r\nPetaluma, California'),
(7, 'Landline Number', '952 587 644'),
(8, 'MAP BOX Token', 'pk.eyJ1IjoidHJhdmVsbWFwcyIsImEiOiJjaXNsajV5dWIwMDZ1Mm9ybjNtYjJyeHkxIn0.nvSgVsU5xjLcLt3HUjPsMg'),
(9, 'Stripe Public Key', 'pk_test_LQa0QZFFINHPYCIFrhBOB333'),
(10, 'Stripe Private Key', 'sk_test_V9iMy4gzazky281XcyPYsVUp'),
(11, 'Printful API Key', 'pza1852e-f41l-vh3x:o5ko-wxoz5b81ciav'),
(14, 'GOOGLE_API_KEY', ' AIzaSyDj-aAxr6sSfw7UWpAzFfct549N7IT6rMo ');

-- --------------------------------------------------------

--
-- Table structure for table `map_style`
--

CREATE TABLE `map_style` (
  `style_id` int(11) NOT NULL,
  `style_name` varchar(50) NOT NULL,
  `style_path` varchar(255) NOT NULL,
  `static_api_path` varchar(255) NOT NULL,
  `style_img` varchar(100) NOT NULL,
  `status` enum('Enable','Disable') NOT NULL DEFAULT 'Enable',
  `modified_datetime` datetime NOT NULL,
  `modified_ip` varchar(62) NOT NULL,
  `isdefault` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `map_style`
--

INSERT INTO `map_style` (`style_id`, `style_name`, `style_path`, `static_api_path`, `style_img`, `status`, `modified_datetime`, `modified_ip`, `isdefault`) VALUES
(17, 'Lava', 'mapbox://styles/dloesch1/cjcv6lns7071t2tlo8h0i7lob', 'pk.eyJ1IjoiZGxvZXNjaDEiLCJhIjoiY2lwMzkwNXFjMDBpM3Yxa3IycGxwZjA4cCJ9.C3ie6DqyKPGf-52aaiTSiw', '33fda0d36222f70a7d1395a55bce79f3.png', 'Enable', '2018-01-28 11:07:55', '76.103.122.27', 1),
(21, 'Shadow', 'mapbox://styles/dloesch1/cjcwj5jtq09062rq6fgki0u4g', 'pk.eyJ1IjoiZGxvZXNjaDEiLCJhIjoiY2lwMzkwNXFjMDBpM3Yxa3IycGxwZjA4cCJ9.C3ie6DqyKPGf-52aaiTSiw', '325d474f301fabf87806943c811594e4.png', 'Enable', '2018-01-27 01:22:09', '76.103.122.27', 0),
(22, 'Mist', 'mapbox://styles/dloesch1/cjcwljfl50bpk2rpgnitisf59', 'pk.eyJ1IjoiZGxvZXNjaDEiLCJhIjoiY2lwMzkwNXFjMDBpM3Yxa3IycGxwZjA4cCJ9.C3ie6DqyKPGf-52aaiTSiw', 'e138c6dc25463e2ad3b961dc3d748a70.png', 'Enable', '2018-01-28 11:10:36', '76.103.122.27', 0),
(23, 'Snow', 'mapbox://styles/dloesch1/cjcv3za4i056d2tqhmrs1shq9', 'pk.eyJ1IjoiZGxvZXNjaDEiLCJhIjoiY2lwMzkwNXFjMDBpM3Yxa3IycGxwZjA4cCJ9.C3ie6DqyKPGf-52aaiTSiw', '7915f718ec270e8786c75ec486460271.png', 'Enable', '2018-01-29 12:12:39', '76.103.122.27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `map_subscribers`
--

CREATE TABLE `map_subscribers` (
  `subscriber_id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `status` enum('Subscribed','Unsubscribed') NOT NULL DEFAULT 'Subscribed',
  `subscribed_date` datetime NOT NULL,
  `subscribed_ip` varchar(62) NOT NULL,
  `unsubscribed_date` datetime DEFAULT NULL,
  `unsubscribed_ip` varchar(62) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `map_admin`
--
ALTER TABLE `map_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `map_coupons`
--
ALTER TABLE `map_coupons`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `map_customer`
--
ALTER TABLE `map_customer`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `map_faq`
--
ALTER TABLE `map_faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `map_mailformat`
--
ALTER TABLE `map_mailformat`
  ADD PRIMARY KEY (`mail_id`);

--
-- Indexes for table `map_map`
--
ALTER TABLE `map_map`
  ADD PRIMARY KEY (`map_id`);

--
-- Indexes for table `map_order`
--
ALTER TABLE `map_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `map_pages`
--
ALTER TABLE `map_pages`
  ADD PRIMARY KEY (`pageid`);

--
-- Indexes for table `map_poster`
--
ALTER TABLE `map_poster`
  ADD PRIMARY KEY (`poster_id`);

--
-- Indexes for table `map_poster_style`
--
ALTER TABLE `map_poster_style`
  ADD PRIMARY KEY (`style_id`);

--
-- Indexes for table `map_sem`
--
ALTER TABLE `map_sem`
  ADD PRIMARY KEY (`sem_id`);

--
-- Indexes for table `map_seo`
--
ALTER TABLE `map_seo`
  ADD PRIMARY KEY (`seo_id`);

--
-- Indexes for table `map_setting`
--
ALTER TABLE `map_setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `map_style`
--
ALTER TABLE `map_style`
  ADD PRIMARY KEY (`style_id`);

--
-- Indexes for table `map_subscribers`
--
ALTER TABLE `map_subscribers`
  ADD PRIMARY KEY (`subscriber_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `map_admin`
--
ALTER TABLE `map_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `map_coupons`
--
ALTER TABLE `map_coupons`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `map_customer`
--
ALTER TABLE `map_customer`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `map_faq`
--
ALTER TABLE `map_faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `map_mailformat`
--
ALTER TABLE `map_mailformat`
  MODIFY `mail_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `map_map`
--
ALTER TABLE `map_map`
  MODIFY `map_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `map_order`
--
ALTER TABLE `map_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `map_pages`
--
ALTER TABLE `map_pages`
  MODIFY `pageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `map_poster`
--
ALTER TABLE `map_poster`
  MODIFY `poster_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `map_seo`
--
ALTER TABLE `map_seo`
  MODIFY `seo_id` bigint(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `map_setting`
--
ALTER TABLE `map_setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `map_style`
--
ALTER TABLE `map_style`
  MODIFY `style_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `map_subscribers`
--
ALTER TABLE `map_subscribers`
  MODIFY `subscriber_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;







-- Manually adding to end of SQLDump, what a dirty hacker :( --
CREATE TABLE IF NOT EXISTS `map_ci_catalog_sessions` (
        `id` varchar(128) NOT NULL,
        `ip_address` varchar(45) NOT NULL,
        `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
        `data` blob NOT NULL,
        KEY `map_ci_catalog_sessions_timestamp` (`timestamp`)
);
ALTER TABLE map_ci_catalog_sessions ADD PRIMARY KEY (id);

CREATE TABLE IF NOT EXISTS `map_ci_admincp_sessions` (
        `id` varchar(128) NOT NULL,
        `ip_address` varchar(45) NOT NULL,
        `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
        `data` blob NOT NULL,
        KEY `map_ci_admincp_sessions_timestamp` (`timestamp`)
);
ALTER TABLE map_ci_admincp_sessions ADD PRIMARY KEY (id);
