-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-09-2021 a las 08:36:17
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `boombang_youtube_3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `armario_fichas`
--

CREATE TABLE `armario_fichas` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ficha_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `armario_fichas`
--

INSERT INTO `armario_fichas` (`id`, `user_id`, `ficha_id`, `created_at`, `updated_at`) VALUES
(11, 4435, 18, NULL, NULL),
(12, 4436, 18, NULL, NULL),
(13, 4437, 18, NULL, NULL),
(14, 4438, 18, NULL, NULL),
(15, 4439, 18, NULL, NULL),
(16, 4440, 18, NULL, NULL),
(17, 4441, 18, NULL, NULL),
(18, 4442, 18, NULL, NULL),
(19, 4443, 18, NULL, NULL),
(20, 4444, 18, NULL, NULL),
(21, 4445, 18, NULL, NULL),
(22, 4446, 18, NULL, NULL),
(23, 4447, 18, NULL, NULL),
(24, 4448, 18, NULL, NULL),
(25, 4449, 18, NULL, NULL),
(26, 4450, 18, NULL, NULL),
(27, 4451, 18, NULL, NULL),
(28, 4452, 18, NULL, NULL),
(29, 4453, 18, NULL, NULL),
(30, 4454, 18, NULL, NULL),
(31, 4455, 18, NULL, NULL),
(32, 4456, 18, NULL, NULL),
(33, 4457, 18, NULL, NULL),
(34, 4458, 18, NULL, NULL),
(35, 4459, 18, NULL, NULL),
(36, 4460, 18, NULL, NULL),
(37, 4461, 18, NULL, NULL),
(38, 4462, 18, NULL, NULL),
(39, 4463, 18, NULL, NULL),
(40, 4464, 18, NULL, NULL),
(41, 4465, 18, NULL, NULL),
(42, 4466, 18, NULL, NULL),
(43, 4467, 18, NULL, NULL),
(44, 4468, 18, NULL, NULL),
(45, 4469, 18, NULL, NULL),
(46, 4470, 18, NULL, NULL),
(47, 4471, 18, NULL, NULL),
(48, 4472, 18, NULL, NULL),
(49, 4473, 18, NULL, NULL),
(50, 4474, 18, NULL, NULL),
(51, 4475, 18, NULL, NULL),
(52, 4476, 18, NULL, NULL),
(53, 4477, 18, NULL, NULL),
(54, 4478, 18, NULL, NULL),
(55, 4479, 18, NULL, NULL),
(56, 4480, 18, NULL, NULL),
(57, 4481, 18, NULL, NULL),
(58, 4482, 18, NULL, NULL),
(59, 4483, 18, NULL, NULL),
(60, 4484, 18, NULL, NULL),
(61, 4485, 18, NULL, NULL),
(62, 4486, 18, NULL, NULL),
(63, 4487, 18, NULL, NULL),
(64, 4488, 18, NULL, NULL),
(65, 4489, 18, NULL, NULL),
(66, 4490, 18, NULL, NULL),
(67, 4491, 18, NULL, NULL),
(68, 4492, 18, NULL, NULL),
(69, 4493, 18, NULL, NULL),
(70, 4494, 18, NULL, NULL),
(71, 4495, 18, NULL, NULL),
(72, 4496, 18, NULL, NULL),
(73, 4497, 18, NULL, NULL),
(74, 4498, 18, NULL, NULL),
(75, 4499, 18, NULL, NULL),
(76, 4500, 18, NULL, NULL),
(77, 4501, 18, NULL, NULL),
(78, 4502, 18, NULL, NULL),
(79, 4503, 18, NULL, NULL),
(80, 4504, 18, NULL, NULL),
(81, 4505, 18, NULL, NULL),
(82, 4506, 18, NULL, NULL),
(83, 4507, 18, NULL, NULL),
(84, 4508, 18, NULL, NULL),
(85, 4509, 18, NULL, NULL),
(86, 4510, 18, NULL, NULL),
(87, 4511, 18, NULL, NULL),
(88, 4512, 18, NULL, NULL),
(89, 4513, 18, NULL, NULL),
(90, 4514, 18, NULL, NULL),
(91, 4515, 18, NULL, NULL),
(92, 4516, 18, NULL, NULL),
(93, 4517, 18, NULL, NULL),
(94, 4518, 18, NULL, NULL),
(95, 4519, 18, NULL, NULL),
(96, 4520, 18, NULL, NULL),
(97, 4521, 18, NULL, NULL),
(98, 4522, 18, NULL, NULL),
(99, 4523, 18, NULL, NULL),
(100, 4524, 18, NULL, NULL),
(101, 4525, 18, NULL, NULL),
(102, 4526, 18, NULL, NULL),
(103, 4527, 18, NULL, NULL),
(104, 4528, 18, NULL, NULL),
(105, 4529, 18, NULL, NULL),
(106, 4530, 18, NULL, NULL),
(107, 4531, 18, NULL, NULL),
(108, 4532, 18, NULL, NULL),
(109, 4533, 18, NULL, NULL),
(110, 4534, 18, NULL, NULL),
(111, 4535, 18, NULL, NULL),
(112, 4536, 18, NULL, NULL),
(113, 4537, 18, NULL, NULL),
(114, 4538, 18, NULL, NULL),
(115, 4539, 18, NULL, NULL),
(116, 4540, 18, NULL, NULL),
(117, 4541, 18, NULL, NULL),
(118, 4542, 18, NULL, NULL),
(119, 4543, 18, NULL, NULL),
(120, 4544, 18, NULL, NULL),
(121, 4545, 18, NULL, NULL),
(122, 4546, 18, NULL, NULL),
(123, 4547, 18, NULL, NULL),
(124, 4548, 18, NULL, NULL),
(125, 4549, 18, NULL, NULL),
(126, 4550, 18, NULL, NULL),
(127, 4551, 18, NULL, NULL),
(128, 4552, 18, NULL, NULL),
(129, 4553, 18, NULL, NULL),
(130, 4554, 18, NULL, NULL),
(131, 4555, 18, NULL, NULL),
(132, 4556, 18, NULL, NULL),
(133, 4557, 18, NULL, NULL),
(134, 4558, 18, NULL, NULL),
(135, 4559, 18, NULL, NULL),
(136, 4560, 18, NULL, NULL),
(137, 4561, 18, NULL, NULL),
(138, 4562, 18, NULL, NULL),
(139, 4563, 18, NULL, NULL),
(140, 4564, 18, NULL, NULL),
(141, 4565, 18, NULL, NULL),
(142, 4566, 18, NULL, NULL),
(143, 4567, 18, NULL, NULL),
(144, 4568, 18, NULL, NULL),
(145, 4569, 18, NULL, NULL),
(146, 4570, 18, NULL, NULL),
(147, 4571, 18, NULL, NULL),
(148, 4572, 18, NULL, NULL),
(149, 4573, 18, NULL, NULL),
(150, 4574, 18, NULL, NULL),
(151, 4575, 18, NULL, NULL),
(152, 4576, 18, NULL, NULL),
(153, 4577, 18, NULL, NULL),
(154, 4578, 18, NULL, NULL),
(155, 4579, 18, NULL, NULL),
(156, 4580, 18, NULL, NULL),
(157, 4581, 18, NULL, NULL),
(158, 4582, 18, NULL, NULL),
(159, 4583, 18, NULL, NULL),
(160, 4584, 18, NULL, NULL),
(161, 4585, 18, NULL, NULL),
(162, 4586, 18, NULL, NULL),
(163, 4587, 18, NULL, NULL),
(164, 4588, 18, NULL, NULL),
(165, 4589, 18, NULL, NULL),
(166, 4590, 18, NULL, NULL),
(167, 4591, 18, NULL, NULL),
(168, 4592, 18, NULL, NULL),
(169, 4593, 18, NULL, NULL),
(170, 4594, 18, NULL, NULL),
(171, 4595, 18, NULL, NULL),
(172, 4596, 18, NULL, NULL),
(173, 4597, 18, NULL, NULL),
(174, 4598, 18, NULL, NULL),
(175, 4599, 18, NULL, NULL),
(176, 4600, 18, NULL, NULL),
(177, 4601, 18, NULL, NULL),
(178, 4602, 18, NULL, NULL),
(179, 4603, 18, NULL, NULL),
(180, 4604, 18, NULL, NULL),
(181, 4605, 18, NULL, NULL),
(182, 4606, 18, NULL, NULL),
(183, 4607, 18, NULL, NULL),
(184, 4608, 18, NULL, NULL),
(185, 4609, 18, NULL, NULL),
(186, 4610, 18, NULL, NULL),
(187, 4611, 18, NULL, NULL),
(188, 4612, 18, NULL, NULL),
(189, 4613, 18, NULL, NULL),
(190, 4614, 18, NULL, NULL),
(191, 4615, 18, NULL, NULL),
(192, 4616, 18, NULL, NULL),
(193, 4617, 18, NULL, NULL),
(194, 4618, 18, NULL, NULL),
(195, 4619, 18, NULL, NULL),
(196, 4620, 18, NULL, NULL),
(197, 4621, 18, NULL, NULL),
(198, 4622, 18, NULL, NULL),
(199, 4623, 18, NULL, NULL),
(200, 4624, 18, NULL, NULL),
(201, 4625, 18, NULL, NULL),
(202, 4626, 18, NULL, NULL),
(203, 4627, 18, NULL, NULL),
(204, 4628, 18, NULL, NULL),
(205, 4629, 18, NULL, NULL),
(206, 4630, 18, NULL, NULL),
(207, 4631, 18, NULL, NULL),
(208, 4632, 18, NULL, NULL),
(209, 4633, 18, NULL, NULL),
(210, 4634, 18, NULL, NULL),
(211, 4635, 18, NULL, NULL),
(212, 4636, 18, NULL, NULL),
(213, 4637, 18, NULL, NULL),
(214, 4638, 18, NULL, NULL),
(215, 4639, 18, NULL, NULL),
(216, 4640, 18, NULL, NULL),
(217, 4641, 18, NULL, NULL),
(218, 4642, 18, NULL, NULL),
(219, 4643, 18, NULL, NULL),
(220, 4644, 18, NULL, NULL),
(221, 4645, 18, NULL, NULL),
(222, 4646, 18, NULL, NULL),
(223, 4647, 18, NULL, NULL),
(224, 4648, 18, NULL, NULL),
(225, 4649, 18, NULL, NULL),
(226, 4650, 18, NULL, NULL),
(227, 4651, 18, NULL, NULL),
(228, 4652, 18, NULL, NULL),
(229, 4653, 18, NULL, NULL),
(230, 4654, 18, NULL, NULL),
(231, 4655, 18, NULL, NULL),
(232, 4656, 18, NULL, NULL),
(233, 4657, 18, NULL, NULL),
(234, 4658, 18, NULL, NULL),
(235, 4659, 18, NULL, NULL),
(236, 4660, 18, NULL, NULL),
(237, 4661, 18, NULL, NULL),
(238, 4662, 18, NULL, NULL),
(239, 4663, 18, NULL, NULL),
(240, 4664, 18, NULL, NULL),
(241, 4665, 18, NULL, NULL),
(242, 4666, 18, NULL, NULL),
(243, 4667, 18, NULL, NULL),
(244, 4668, 18, NULL, NULL),
(245, 4669, 18, NULL, NULL),
(246, 4670, 18, NULL, NULL),
(247, 4671, 18, NULL, NULL),
(248, 4672, 18, NULL, NULL),
(249, 4673, 18, NULL, NULL),
(250, 4674, 18, NULL, NULL),
(251, 4675, 18, NULL, NULL),
(252, 4676, 18, NULL, NULL),
(253, 4677, 18, NULL, NULL),
(254, 4678, 18, NULL, NULL),
(255, 4679, 18, NULL, NULL),
(256, 4680, 18, NULL, NULL),
(257, 4681, 18, NULL, NULL),
(258, 4682, 18, NULL, NULL),
(259, 4683, 18, NULL, NULL),
(260, 4684, 18, NULL, NULL),
(261, 4685, 18, NULL, NULL),
(262, 4686, 18, NULL, NULL),
(263, 4687, 18, NULL, NULL),
(264, 4688, 18, NULL, NULL),
(265, 4689, 18, NULL, NULL),
(266, 4690, 18, NULL, NULL),
(267, 4691, 18, NULL, NULL),
(268, 4692, 18, NULL, NULL),
(269, 4693, 18, NULL, NULL),
(270, 4694, 18, NULL, NULL),
(271, 4695, 18, NULL, NULL),
(272, 4696, 18, NULL, NULL),
(273, 4697, 18, NULL, NULL),
(274, 4698, 18, NULL, NULL),
(275, 4699, 18, NULL, NULL),
(276, 4700, 18, NULL, NULL),
(277, 4701, 18, NULL, NULL),
(278, 4702, 18, NULL, NULL),
(279, 4703, 18, NULL, NULL),
(280, 4704, 18, NULL, NULL),
(281, 4705, 18, NULL, NULL),
(282, 4706, 18, NULL, NULL),
(283, 4707, 18, NULL, NULL),
(284, 4708, 18, NULL, NULL),
(285, 4709, 18, NULL, NULL),
(286, 4710, 18, NULL, NULL),
(287, 4711, 18, NULL, NULL),
(288, 4712, 18, NULL, NULL),
(289, 4713, 18, NULL, NULL),
(290, 4714, 18, NULL, NULL),
(291, 4715, 18, NULL, NULL),
(292, 4716, 18, NULL, NULL),
(293, 4717, 18, NULL, NULL),
(294, 4718, 18, NULL, NULL),
(295, 4719, 18, NULL, NULL),
(296, 4720, 18, NULL, NULL),
(297, 4721, 18, NULL, NULL),
(298, 4722, 18, NULL, NULL),
(299, 4723, 18, NULL, NULL),
(300, 4724, 18, NULL, NULL),
(301, 4725, 18, NULL, NULL),
(302, 4726, 18, NULL, NULL),
(303, 4727, 18, NULL, NULL),
(304, 4728, 18, NULL, NULL),
(305, 4729, 18, NULL, NULL),
(306, 4730, 18, NULL, NULL),
(307, 4731, 18, NULL, NULL),
(308, 4732, 18, NULL, NULL),
(309, 4733, 18, NULL, NULL),
(310, 4734, 18, NULL, NULL),
(311, 4735, 18, NULL, NULL),
(312, 4736, 18, NULL, NULL),
(313, 4737, 18, NULL, NULL),
(314, 4738, 18, NULL, NULL),
(315, 4739, 18, NULL, NULL),
(316, 4740, 18, NULL, NULL),
(317, 4741, 18, NULL, NULL),
(318, 4742, 18, NULL, NULL),
(319, 4743, 18, NULL, NULL),
(320, 4744, 18, NULL, NULL),
(321, 4745, 18, NULL, NULL),
(322, 4746, 18, NULL, NULL),
(323, 4747, 18, NULL, NULL),
(324, 4748, 18, NULL, NULL),
(325, 4749, 18, NULL, NULL),
(326, 4750, 18, NULL, NULL),
(327, 4751, 18, NULL, NULL),
(328, 4752, 18, NULL, NULL),
(329, 4753, 18, NULL, NULL),
(330, 4754, 18, NULL, NULL),
(331, 4755, 18, NULL, NULL),
(332, 4756, 18, NULL, NULL),
(333, 4757, 18, NULL, NULL),
(334, 4758, 18, NULL, NULL),
(335, 4759, 18, NULL, NULL),
(336, 4760, 18, NULL, NULL),
(337, 4761, 18, NULL, NULL),
(338, 4762, 18, NULL, NULL),
(339, 4763, 18, NULL, NULL),
(340, 4764, 18, NULL, NULL),
(341, 4765, 18, NULL, NULL),
(342, 4766, 18, NULL, NULL),
(343, 4767, 18, NULL, NULL),
(344, 4768, 18, NULL, NULL),
(345, 4769, 18, NULL, NULL),
(346, 4770, 18, NULL, NULL),
(347, 4771, 18, NULL, NULL),
(348, 4772, 18, NULL, NULL),
(349, 4773, 18, NULL, NULL),
(350, 4774, 18, NULL, NULL),
(351, 4775, 18, NULL, NULL),
(352, 4776, 18, NULL, NULL),
(353, 4777, 18, NULL, NULL),
(354, 4778, 18, NULL, NULL),
(355, 4779, 18, NULL, NULL),
(356, 4780, 18, NULL, NULL),
(357, 4781, 18, NULL, NULL),
(358, 4782, 18, NULL, NULL),
(359, 4783, 18, NULL, NULL),
(360, 4784, 18, NULL, NULL),
(361, 4785, 18, NULL, NULL),
(362, 4786, 18, NULL, NULL),
(363, 4787, 18, NULL, NULL),
(364, 4788, 18, NULL, NULL),
(365, 4789, 18, NULL, NULL),
(366, 4790, 18, NULL, NULL),
(367, 4791, 18, NULL, NULL),
(368, 4792, 18, NULL, NULL),
(369, 4793, 18, NULL, NULL),
(370, 4794, 18, NULL, NULL),
(371, 4795, 18, NULL, NULL),
(372, 4796, 18, NULL, NULL),
(373, 4797, 18, NULL, NULL),
(374, 4798, 18, NULL, NULL),
(375, 4799, 18, NULL, NULL),
(376, 4800, 18, NULL, NULL),
(377, 4801, 18, NULL, NULL),
(378, 4802, 18, NULL, NULL),
(379, 4803, 18, NULL, NULL),
(380, 4804, 18, NULL, NULL),
(381, 4805, 18, NULL, NULL),
(382, 4806, 18, NULL, NULL),
(383, 4807, 18, NULL, NULL),
(384, 4808, 18, NULL, NULL),
(385, 4809, 18, NULL, NULL),
(386, 4810, 18, NULL, NULL),
(387, 4811, 18, NULL, NULL),
(388, 4812, 18, NULL, NULL),
(389, 4813, 18, NULL, NULL),
(390, 4814, 18, NULL, NULL),
(391, 4815, 18, NULL, NULL),
(392, 4816, 18, NULL, NULL),
(393, 4817, 18, NULL, NULL),
(394, 4818, 18, NULL, NULL),
(395, 4819, 18, NULL, NULL),
(396, 4820, 18, NULL, NULL),
(397, 4821, 18, NULL, NULL),
(398, 4822, 18, NULL, NULL),
(399, 4823, 18, NULL, NULL),
(400, 4824, 18, NULL, NULL),
(401, 4825, 18, NULL, NULL),
(402, 4826, 18, NULL, NULL),
(403, 4827, 18, NULL, NULL),
(404, 4828, 18, NULL, NULL),
(405, 4829, 18, NULL, NULL),
(406, 4830, 18, NULL, NULL),
(407, 4831, 18, NULL, NULL),
(408, 4832, 18, NULL, NULL),
(409, 4833, 18, NULL, NULL),
(410, 4834, 18, NULL, NULL),
(411, 4835, 18, NULL, NULL),
(412, 4836, 18, NULL, NULL),
(413, 4837, 18, NULL, NULL),
(414, 4838, 18, NULL, NULL),
(415, 4839, 18, NULL, NULL),
(416, 4840, 18, NULL, NULL),
(417, 4841, 18, NULL, NULL),
(418, 4842, 18, NULL, NULL),
(419, 4843, 18, NULL, NULL),
(420, 4844, 18, NULL, NULL),
(421, 4845, 18, NULL, NULL),
(422, 4846, 18, NULL, NULL),
(423, 4847, 18, NULL, NULL),
(424, 4848, 18, NULL, NULL),
(425, 4849, 18, NULL, NULL),
(426, 4850, 18, NULL, NULL),
(427, 4851, 18, NULL, NULL),
(428, 4852, 18, NULL, NULL),
(429, 4853, 18, NULL, NULL),
(430, 4854, 18, NULL, NULL),
(431, 4855, 18, NULL, NULL),
(432, 4856, 18, NULL, NULL),
(433, 4857, 18, NULL, NULL),
(434, 4858, 18, NULL, NULL),
(435, 4859, 18, NULL, NULL),
(436, 4860, 18, NULL, NULL),
(437, 4861, 18, NULL, NULL),
(438, 4862, 18, NULL, NULL),
(439, 4863, 18, NULL, NULL),
(440, 4864, 18, NULL, NULL),
(441, 4865, 18, NULL, NULL),
(442, 4866, 18, NULL, NULL),
(443, 4867, 18, NULL, NULL),
(444, 4868, 18, NULL, NULL),
(445, 4869, 18, NULL, NULL),
(446, 4870, 18, NULL, NULL),
(447, 4871, 18, NULL, NULL),
(448, 4872, 18, NULL, NULL),
(449, 4873, 18, NULL, NULL),
(450, 4874, 18, NULL, NULL),
(451, 4875, 18, NULL, NULL),
(452, 4876, 18, NULL, NULL),
(453, 4877, 18, NULL, NULL),
(454, 4878, 18, NULL, NULL),
(455, 4879, 18, NULL, NULL),
(456, 4880, 18, NULL, NULL),
(457, 4881, 18, NULL, NULL),
(458, 4882, 18, NULL, NULL),
(459, 4883, 18, NULL, NULL),
(460, 4884, 18, NULL, NULL),
(461, 4885, 18, NULL, NULL),
(462, 4886, 18, NULL, NULL),
(463, 4887, 18, NULL, NULL),
(464, 4888, 18, NULL, NULL),
(465, 4889, 18, NULL, NULL),
(466, 4890, 18, NULL, NULL),
(467, 4891, 18, NULL, NULL),
(468, 4892, 18, NULL, NULL),
(469, 4893, 18, NULL, NULL),
(470, 4894, 18, NULL, NULL),
(471, 4895, 18, NULL, NULL),
(472, 4896, 18, NULL, NULL),
(473, 4897, 18, NULL, NULL),
(474, 4898, 18, NULL, NULL),
(475, 4899, 18, NULL, NULL),
(476, 4900, 18, NULL, NULL),
(477, 4901, 18, NULL, NULL),
(478, 4902, 18, NULL, NULL),
(479, 4903, 18, NULL, NULL),
(480, 4904, 18, NULL, NULL),
(481, 4905, 18, NULL, NULL),
(482, 4906, 18, NULL, NULL),
(483, 4907, 18, NULL, NULL),
(484, 4908, 18, NULL, NULL),
(485, 4909, 18, NULL, NULL),
(486, 4910, 18, NULL, NULL),
(487, 4911, 18, NULL, NULL),
(488, 4912, 18, NULL, NULL),
(489, 4913, 18, NULL, NULL),
(490, 4914, 18, NULL, NULL),
(491, 4915, 18, NULL, NULL),
(492, 4916, 18, NULL, NULL),
(493, 4917, 18, NULL, NULL),
(494, 4918, 18, NULL, NULL),
(495, 4919, 18, NULL, NULL),
(496, 4920, 18, NULL, NULL),
(497, 4921, 18, NULL, NULL),
(498, 4922, 18, NULL, NULL),
(499, 4923, 18, NULL, NULL),
(500, 4924, 18, NULL, NULL),
(501, 4925, 18, NULL, NULL),
(502, 4926, 18, NULL, NULL),
(503, 4927, 18, NULL, NULL),
(504, 4928, 18, NULL, NULL),
(505, 4929, 18, NULL, NULL),
(506, 4930, 18, NULL, NULL),
(507, 4931, 18, NULL, NULL),
(508, 4932, 18, NULL, NULL),
(509, 4933, 18, NULL, NULL),
(510, 4934, 18, NULL, NULL),
(511, 4935, 18, NULL, NULL),
(512, 4936, 18, NULL, NULL),
(513, 4937, 18, NULL, NULL),
(514, 4938, 18, NULL, NULL),
(515, 4939, 18, NULL, NULL),
(516, 4940, 18, NULL, NULL),
(517, 4941, 18, NULL, NULL),
(518, 4942, 18, NULL, NULL),
(519, 4943, 18, NULL, NULL),
(520, 4944, 18, NULL, NULL),
(521, 4945, 18, NULL, NULL),
(522, 4946, 18, NULL, NULL),
(523, 4947, 18, NULL, NULL),
(524, 4948, 18, NULL, NULL),
(525, 4949, 18, NULL, NULL),
(526, 4950, 18, NULL, NULL),
(527, 4951, 18, NULL, NULL),
(528, 4952, 18, NULL, NULL),
(529, 4953, 18, NULL, NULL),
(530, 4954, 18, NULL, NULL),
(531, 4955, 18, NULL, NULL),
(532, 4956, 18, NULL, NULL),
(533, 4957, 18, NULL, NULL),
(534, 4958, 18, NULL, NULL),
(535, 4959, 18, NULL, NULL),
(536, 4960, 18, NULL, NULL),
(537, 4961, 18, NULL, NULL),
(538, 4962, 18, NULL, NULL),
(539, 4963, 18, NULL, NULL),
(540, 4964, 18, NULL, NULL),
(541, 4965, 18, NULL, NULL),
(542, 4966, 18, NULL, NULL),
(543, 4967, 18, NULL, NULL),
(544, 4968, 18, NULL, NULL),
(545, 4969, 18, NULL, NULL),
(546, 4970, 18, NULL, NULL),
(547, 4971, 18, NULL, NULL),
(548, 4972, 18, NULL, NULL),
(549, 4973, 18, NULL, NULL),
(550, 4974, 18, NULL, NULL),
(551, 4975, 18, NULL, NULL),
(552, 4976, 18, NULL, NULL),
(553, 4977, 18, NULL, NULL),
(554, 4978, 18, NULL, NULL),
(555, 4979, 18, NULL, NULL),
(556, 4980, 18, NULL, NULL),
(557, 4981, 18, NULL, NULL),
(558, 4982, 18, NULL, NULL),
(559, 4983, 18, NULL, NULL),
(560, 4984, 18, NULL, NULL),
(561, 4985, 18, NULL, NULL),
(562, 4986, 18, NULL, NULL),
(563, 4987, 18, NULL, NULL),
(564, 4988, 18, NULL, NULL),
(565, 4989, 18, NULL, NULL),
(566, 4990, 18, NULL, NULL),
(567, 4991, 18, NULL, NULL),
(568, 4992, 18, NULL, NULL),
(569, 4993, 18, NULL, NULL),
(570, 4994, 18, NULL, NULL),
(571, 4995, 18, NULL, NULL),
(572, 4996, 18, NULL, NULL),
(573, 4997, 18, NULL, NULL),
(574, 4998, 18, NULL, NULL),
(575, 4999, 18, NULL, NULL),
(576, 5000, 18, NULL, NULL),
(577, 5001, 18, NULL, NULL),
(578, 5002, 18, NULL, NULL),
(579, 5003, 18, NULL, NULL),
(580, 5004, 18, NULL, NULL),
(581, 5005, 18, NULL, NULL),
(582, 5006, 18, NULL, NULL),
(583, 5007, 18, NULL, NULL),
(1034, 4435, 1002, NULL, NULL),
(1035, 4437, 1000, NULL, NULL),
(1036, 4438, 1000, NULL, NULL),
(1037, 4440, 1000, NULL, NULL),
(1038, 4441, 1000, NULL, NULL),
(1039, 4447, 1000, NULL, NULL),
(1040, 4448, 1000, NULL, NULL),
(1041, 4450, 1000, NULL, NULL),
(1042, 4452, 1000, NULL, NULL),
(1043, 4453, 1000, NULL, NULL),
(1044, 4454, 1000, NULL, NULL),
(1045, 4455, 1000, NULL, NULL),
(1046, 4456, 1000, NULL, NULL),
(1047, 4457, 1000, NULL, NULL),
(1048, 4458, 1000, NULL, NULL),
(1049, 4459, 1000, NULL, NULL),
(1050, 4468, 1002, NULL, NULL),
(1051, 4469, 1000, NULL, NULL),
(1052, 4470, 1000, NULL, NULL),
(1053, 4471, 1004, NULL, NULL),
(1054, 4489, 1004, NULL, NULL),
(1055, 4491, 1000, NULL, NULL),
(1056, 4492, 1000, NULL, NULL),
(1057, 4493, 1000, NULL, NULL),
(1058, 4497, 1000, NULL, NULL),
(1059, 4498, 1000, NULL, NULL),
(1060, 4501, 1000, NULL, NULL),
(1061, 4502, 1000, NULL, NULL),
(1062, 4503, 1000, NULL, NULL),
(1063, 4504, 1000, NULL, NULL),
(1064, 4505, 1000, NULL, NULL),
(1065, 4506, 1000, NULL, NULL),
(1066, 4507, 1000, NULL, NULL),
(1067, 4508, 1000, NULL, NULL),
(1068, 4524, 1000, NULL, NULL),
(1069, 4532, 1000, NULL, NULL),
(1070, 4644, 1010, NULL, NULL),
(1071, 4725, 1008, NULL, NULL),
(1072, 4779, 1001, NULL, NULL),
(1073, 4808, 1010, NULL, NULL),
(1074, 4835, 1002, NULL, NULL),
(1075, 4871, 1004, NULL, NULL),
(1076, 4886, 1004, NULL, NULL),
(1077, 4888, 1010, NULL, NULL),
(1078, 4891, 1003, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bb_managers`
--

CREATE TABLE `bb_managers` (
  `id` int(11) NOT NULL,
  `proximo_evento` int(11) NOT NULL DEFAULT -1,
  `tiempo_evento` int(11) NOT NULL DEFAULT -1,
  `tipo_evento` int(11) NOT NULL DEFAULT -1,
  `loteria_semanal` int(11) NOT NULL DEFAULT -1,
  `ranking_semanal` int(11) NOT NULL DEFAULT -1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bpad_amigos`
--

CREATE TABLE `bpad_amigos` (
  `id` int(11) NOT NULL,
  `ID_1` int(11) NOT NULL,
  `Nota` varchar(250) NOT NULL DEFAULT '¡Bienvenidos a Yocomania!',
  `Marquilla` int(11) NOT NULL DEFAULT 1,
  `ID_2` int(11) NOT NULL,
  `Solicitud` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bpad_amigos`
--

INSERT INTO `bpad_amigos` (`id`, `ID_1`, `Nota`, `Marquilla`, `ID_2`, `Solicitud`, `created_at`, `updated_at`) VALUES
(37, 4436, '¡Bienvenidos a BoomBang!', 1, 4435, 0, NULL, NULL),
(38, 4435, '¡Bienvenidos a BoomBang!', 4, 4436, 0, NULL, NULL),
(39, 4437, '¡Bienvenidos a BoomBang!', 1, 4435, 0, NULL, NULL),
(40, 4435, '¡Bienvenidos a BoomBang!', 2, 4437, 0, NULL, NULL),
(41, 4435, '¡Bienvenidos a BoomBang!', 1, 4464, 0, NULL, NULL),
(42, 4464, '¡Bienvenidos a BoomBang!', 1, 4435, 0, NULL, NULL),
(43, 4435, '¡Bienvenidos a BoomBang!', 1, 4470, 0, NULL, NULL),
(44, 4470, '¡Bienvenidos a BoomBang!', 1, 4435, 0, NULL, NULL),
(45, 4470, '¡Bienvenidos a BoomBang!', 1, 4464, 0, NULL, NULL),
(46, 4464, '¡Bienvenidos a BoomBang!', 1, 4470, 0, NULL, NULL),
(47, 4480, '¡Bienvenidos a BoomBang!', 1, 4483, 1, NULL, NULL),
(48, 4481, '¡Bienvenidos a BoomBang!', 1, 4483, 0, NULL, NULL),
(49, 4475, '¡Bienvenidos a BoomBang!', 1, 4483, 1, NULL, NULL),
(50, 4472, '¡Bienvenidos a BoomBang!', 1, 4483, 0, NULL, NULL),
(51, 4476, '¡Bienvenidos a BoomBang!', 1, 4483, 0, NULL, NULL),
(52, 4483, '¡Bienvenidos a BoomBang!', 1, 4472, 0, NULL, NULL),
(53, 4480, '¡Bienvenidos a BoomBang!', 1, 4472, 1, NULL, NULL),
(54, 4481, '¡Bienvenidos a BoomBang!', 1, 4472, 0, NULL, NULL),
(55, 4475, '¡Bienvenidos a BoomBang!', 1, 4472, 1, NULL, NULL),
(56, 4476, '¡Bienvenidos a BoomBang!', 1, 4472, 0, NULL, NULL),
(57, 4472, '¡Bienvenidos a BoomBang!', 1, 4481, 0, NULL, NULL),
(58, 4483, '¡Bienvenidos a BoomBang!', 1, 4481, 0, NULL, NULL),
(59, 4472, '¡Bienvenidos a BoomBang!', 1, 4476, 0, NULL, NULL),
(60, 4483, '¡Bienvenidos a BoomBang!', 1, 4476, 0, NULL, NULL),
(61, 4472, '¡Bienvenidos a BoomBang!', 1, 4436, 0, NULL, NULL),
(62, 4436, '¡Bienvenidos a BoomBang!', 1, 4472, 0, NULL, NULL),
(63, 4479, '¡Bienvenidos a BoomBang!', 1, 4472, 1, NULL, NULL),
(64, 4471, '¡Bienvenidos a BoomBang!', 1, 4447, 0, NULL, NULL),
(65, 4437, '¡Bienvenidos a BoomBang!', 1, 4447, 0, NULL, NULL),
(66, 4470, '¡Bienvenidos a BoomBang!', 1, 4447, 0, NULL, NULL),
(67, 4447, '¡Bienvenidos a BoomBang!', 1, 4470, 0, NULL, NULL),
(68, 4447, '¡Bienvenidos a BoomBang!', 1, 4471, 0, NULL, NULL),
(69, 4447, '¡Bienvenidos a BoomBang!', 1, 4437, 0, NULL, NULL),
(70, 4437, '¡Bienvenidos a BoomBang!', 1, 4471, 0, NULL, NULL),
(71, 4471, '¡Bienvenidos a BoomBang!', 1, 4437, 0, NULL, NULL),
(72, 4437, '¡Bienvenidos a BoomBang!', 1, 4468, 0, NULL, NULL),
(73, 4471, '¡Bienvenidos a BoomBang!', 1, 4468, 0, NULL, NULL),
(74, 4468, '¡Bienvenidos a BoomBang!', 1, 4437, 0, NULL, NULL),
(75, 4468, '¡Bienvenidos a BoomBang!', 1, 4491, 0, NULL, NULL),
(76, 4491, '¡Bienvenidos a BoomBang!', 1, 4468, 0, NULL, NULL),
(77, 4468, '¡Bienvenidos a BoomBang!', 1, 4471, 0, NULL, NULL),
(78, 4491, '¡Bienvenidos a BoomBang!', 1, 4492, 0, NULL, NULL),
(79, 4492, '¡Bienvenidos a BoomBang!', 1, 4491, 0, NULL, NULL),
(80, 4468, '¡Bienvenidos a BoomBang!', 1, 4447, 0, NULL, NULL),
(81, 4447, '¡Bienvenidos a BoomBang!', 1, 4468, 0, NULL, NULL),
(82, 4491, '¡Bienvenidos a BoomBang!', 1, 4447, 0, NULL, NULL),
(83, 4492, '¡Bienvenidos a BoomBang!', 1, 4447, 0, NULL, NULL),
(84, 4447, '¡Bienvenidos a BoomBang!', 1, 4491, 0, NULL, NULL),
(85, 4447, '¡Bienvenidos a BoomBang!', 1, 4492, 0, NULL, NULL),
(86, 4461, '¡Bienvenidos a BoomBang!', 1, 4454, 1, NULL, NULL),
(87, 4468, '¡Bienvenidos a BoomBang!', 1, 4454, 0, NULL, NULL),
(88, 4454, '¡Bienvenidos a BoomBang!', 1, 4468, 0, NULL, NULL),
(89, 4471, '¡Bienvenidos a BoomBang!', 1, 4441, 0, NULL, NULL),
(90, 4471, '¡Bienvenidos a BoomBang!', 1, 4500, 0, NULL, NULL),
(91, 4441, '¡Bienvenidos a BoomBang!', 1, 4471, 0, NULL, NULL),
(92, 4500, '¡Bienvenidos a BoomBang!', 1, 4471, 0, NULL, NULL),
(93, 4508, '¡Bienvenidos a BoomBang!', 1, 4507, 0, NULL, NULL),
(94, 4507, '¡Bienvenidos a BoomBang!', 1, 4508, 0, NULL, NULL),
(95, 4507, '¡Bienvenidos a BoomBang!', 1, 4447, 0, NULL, NULL),
(96, 4447, '¡Bienvenidos a BoomBang!', 1, 4507, 0, NULL, NULL),
(97, 4464, '¡Bienvenidos a BoomBang!', 1, 4509, 0, NULL, NULL),
(98, 4509, '¡Bienvenidos a BoomBang!', 1, 4464, 0, NULL, NULL),
(99, 4517, '¡Bienvenidos a BoomBang!', 1, 4509, 1, NULL, NULL),
(100, 4464, '¡Bienvenidos a BoomBang!', 1, 4519, 0, NULL, NULL),
(101, 4517, '¡Bienvenidos a BoomBang!', 1, 4519, 1, NULL, NULL),
(102, 4509, '¡Bienvenidos a BoomBang!', 1, 4519, 1, NULL, NULL),
(103, 4519, '¡Bienvenidos a BoomBang!', 1, 4522, 0, NULL, NULL),
(104, 4522, '¡Bienvenidos a BoomBang!', 1, 4519, 0, NULL, NULL),
(105, 4454, '¡Bienvenidos a BoomBang!', 1, 4519, 0, NULL, NULL),
(106, 4519, '¡Bienvenidos a BoomBang!', 1, 4454, 0, NULL, NULL),
(107, 4519, '¡Bienvenidos a BoomBang!', 1, 4464, 0, NULL, NULL),
(108, 4526, '¡Bienvenidos a BoomBang!', 1, 4525, 0, NULL, NULL),
(109, 4525, '¡Bienvenidos a BoomBang!', 1, 4526, 0, NULL, NULL),
(110, 4510, '¡Bienvenidos a BoomBang!', 1, 4527, 1, NULL, NULL),
(111, 4471, '¡Bienvenidos a BoomBang!', 1, 4489, 0, NULL, NULL),
(112, 4489, '¡Bienvenidos a BoomBang!', 1, 4471, 0, NULL, NULL),
(113, 4532, '¡Bienvenidos a BoomBang!', 1, 4543, 0, NULL, NULL),
(114, 4543, '¡Bienvenidos a BoomBang!', 1, 4532, 0, NULL, NULL),
(115, 4532, '¡Bienvenidos a BoomBang!', 1, 4435, 0, NULL, NULL),
(116, 4435, '¡Bienvenidos a BoomBang!', 1, 4532, 0, NULL, NULL),
(117, 4564, '¡Bienvenidos a BoomBang!', 1, 4489, 0, NULL, NULL),
(118, 4564, '¡Bienvenidos a BoomBang!', 1, 4558, 0, NULL, NULL),
(119, 4489, '¡Bienvenidos a BoomBang!', 1, 4564, 0, NULL, NULL),
(120, 4558, '¡Bienvenidos a BoomBang!', 1, 4564, 0, NULL, NULL),
(121, 4532, '¡Bienvenidos a BoomBang!', 1, 4534, 0, NULL, NULL),
(122, 4534, '¡Bienvenidos a BoomBang!', 1, 4532, 0, NULL, NULL),
(123, 4532, '¡Bienvenidos a BoomBang!', 1, 4558, 0, NULL, NULL),
(124, 4509, '¡Bienvenidos a BoomBang!', 1, 4558, 1, NULL, NULL),
(125, 4558, '¡Bienvenidos a BoomBang!', 1, 4532, 0, NULL, NULL),
(126, 4568, '¡Bienvenidos a BoomBang!', 1, 4558, 0, NULL, NULL),
(127, 4558, '¡Bienvenidos a BoomBang!', 1, 4568, 0, NULL, NULL),
(128, 4578, '¡Bienvenidos a BoomBang!', 1, 4577, 0, NULL, NULL),
(129, 4577, '¡Bienvenidos a BoomBang!', 1, 4578, 0, NULL, NULL),
(130, 4572, '¡Bienvenidos a BoomBang!', 1, 4582, 0, NULL, NULL),
(131, 4582, '¡Bienvenidos a BoomBang!', 1, 4572, 0, NULL, NULL),
(132, 4590, '¡Bienvenidos a BoomBang!', 1, 4591, 0, NULL, NULL),
(133, 4591, '¡Bienvenidos a BoomBang!', 1, 4590, 0, NULL, NULL),
(134, 4591, '¡Bienvenidos a BoomBang!', 1, 4594, 0, NULL, NULL),
(135, 4594, '¡Bienvenidos a BoomBang!', 1, 4591, 0, NULL, NULL),
(136, 4591, '¡Bienvenidos a BoomBang!', 1, 4598, 0, NULL, NULL),
(137, 4598, '¡Bienvenidos a BoomBang!', 1, 4591, 0, NULL, NULL),
(138, 4591, '¡Bienvenidos a BoomBang!', 1, 4608, 0, NULL, NULL),
(139, 4608, '¡Bienvenidos a BoomBang!', 1, 4591, 0, NULL, NULL),
(140, 4471, '¡Bienvenidos a BoomBang!', 1, 4616, 0, NULL, NULL),
(141, 4435, '¡Bienvenidos a BoomBang!', 1, 4620, 0, NULL, NULL),
(142, 4572, '¡Bienvenidos a BoomBang!', 1, 4620, 0, NULL, NULL),
(143, 4620, '¡Bienvenidos a BoomBang!', 1, 4572, 0, NULL, NULL),
(144, 4572, 'vennnnn', 1, 4641, 0, NULL, NULL),
(145, 4641, '¡Bienvenidos a BoomBang!', 1, 4572, 0, NULL, NULL),
(146, 4620, '¡Bienvenidos a BoomBang!', 1, 4435, 0, NULL, NULL),
(147, 4435, '¡Bienvenidos a BoomBang!', 1, 4641, 0, NULL, NULL),
(148, 4641, '¡Bienvenidos a BoomBang!', 1, 4435, 0, NULL, NULL),
(149, 4725, 'podes venir\r', 1, 4651, 0, NULL, NULL),
(150, 4435, '¡Bienvenidos a BoomBang!', 1, 4651, 0, NULL, NULL),
(151, 4438, '¡Bienvenidos a BoomBang!', 1, 4651, 0, NULL, NULL),
(152, 4651, '¡Bienvenidos a BoomBang!', 1, 4435, 0, NULL, NULL),
(153, 4651, '¡Bienvenidos a BoomBang!', 1, 4725, 0, NULL, NULL),
(154, 4738, '¡Bienvenidos a BoomBang!', 1, 4737, 0, NULL, NULL),
(155, 4737, '¡Bienvenidos a BoomBang!', 1, 4738, 0, NULL, NULL),
(156, 4651, '¡Bienvenidos a BoomBang!', 1, 4438, 0, NULL, NULL),
(157, 4436, '¡Bienvenidos a BoomBang!', 1, 4651, 0, NULL, NULL),
(158, 4651, '¡Bienvenidos a BoomBang!', 1, 4436, 0, NULL, NULL),
(159, 4468, '¡Bienvenidos a BoomBang!', 1, 4651, 0, NULL, NULL),
(160, 4651, '¡Bienvenidos a BoomBang!', 1, 4468, 0, NULL, NULL),
(161, 4616, '¡Bienvenidos a BoomBang!', 1, 4471, 0, NULL, NULL),
(162, 4801, '¡Bienvenidos a BoomBang!', 1, 4800, 0, NULL, NULL),
(163, 4800, '¡Bienvenidos a BoomBang!', 1, 4801, 0, NULL, NULL),
(164, 4493, '¡Bienvenidos a BoomBang!', 1, 4454, 0, NULL, NULL),
(165, 4454, '¡Bienvenidos a BoomBang!', 1, 4493, 0, NULL, NULL),
(166, 4801, '¡Bienvenidos a BoomBang!', 1, 4651, 0, NULL, NULL),
(167, 4802, '¡Bienvenidos a BoomBang!', 1, 4651, 0, NULL, NULL),
(168, 4651, '¡Bienvenidos a BoomBang!', 1, 4802, 0, NULL, NULL),
(169, 4651, '¡Bienvenidos a BoomBang!', 1, 4801, 0, NULL, NULL),
(170, 4803, '¡Bienvenidos a BoomBang!', 1, 4651, 0, NULL, NULL),
(171, 4493, '¡Bienvenidos a BoomBang!', 1, 4651, 0, NULL, NULL),
(172, 4796, '¡Bienvenidos a BoomBang!', 1, 4651, 1, NULL, NULL),
(173, 4651, '¡Bienvenidos a BoomBang!', 1, 4803, 0, NULL, NULL),
(174, 4454, '¡Bienvenidos a BoomBang!', 1, 4651, 0, NULL, NULL),
(175, 4651, '¡Bienvenidos a BoomBang!', 1, 4454, 0, NULL, NULL),
(176, 4651, '¡Bienvenidos a BoomBang!', 1, 4493, 0, NULL, NULL),
(177, 4644, '¡Bienvenidos a BoomBang!', 1, 4454, 0, NULL, NULL),
(178, 4454, '¡Bienvenidos a BoomBang!', 1, 4644, 0, NULL, NULL),
(179, 4454, '¡Bienvenidos a BoomBang!', 1, 4804, 0, NULL, NULL),
(180, 4804, '¡Bienvenidos a BoomBang!', 1, 4454, 0, NULL, NULL),
(181, 4804, '¡Bienvenidos a BoomBang!', 1, 4454, 0, NULL, NULL),
(182, 4454, '¡Bienvenidos a BoomBang!', 1, 4804, 0, NULL, NULL),
(183, 4493, '¡Bienvenidos a BoomBang!', 1, 4458, 0, NULL, NULL),
(184, 4448, '¡Bienvenidos a BoomBang!', 1, 4458, 0, NULL, NULL),
(185, 4458, '¡Bienvenidos a BoomBang!', 1, 4448, 0, NULL, NULL),
(186, 4458, '¡Bienvenidos a BoomBang!', 1, 4493, 0, NULL, NULL),
(187, 4826, '¡Bienvenidos a BoomBang!', 1, 4493, 0, NULL, NULL),
(188, 4493, '¡Bienvenidos a BoomBang!', 1, 4826, 0, NULL, NULL),
(189, 4468, '¡Bienvenidos a BoomBang!', 1, 4458, 0, NULL, NULL),
(190, 4725, '¡Bienvenidos a BoomBang!', 1, 4458, 0, NULL, NULL),
(191, 4458, '¡Bienvenidos a BoomBang!', 1, 4468, 0, NULL, NULL),
(192, 4458, '¡Bienvenidos a BoomBang!', 1, 4725, 0, NULL, NULL),
(193, 4831, '¡Bienvenidos a BoomBang!', 1, 4458, 0, NULL, NULL),
(194, 4458, '¡Bienvenidos a BoomBang!', 1, 4831, 0, NULL, NULL),
(195, 4651, '¡Bienvenidos a BoomBang!', 1, 4458, 0, NULL, NULL),
(196, 4458, '¡Bienvenidos a BoomBang!', 1, 4651, 0, NULL, NULL),
(197, 4644, '¡Bienvenidos a BoomBang!', 1, 4738, 0, NULL, NULL),
(198, 4738, '¡Bienvenidos a BoomBang!', 1, 4644, 0, NULL, NULL),
(199, 4842, '¡Bienvenidos a BoomBang!', 1, 4470, 0, NULL, NULL),
(200, 4470, '¡Bienvenidos a BoomBang!', 1, 4842, 0, NULL, NULL),
(201, 4644, '¡Bienvenidos a BoomBang!', 1, 4846, 0, NULL, NULL),
(202, 4846, '¡Bienvenidos a BoomBang!', 1, 4644, 0, NULL, NULL),
(203, 4738, '', 1, 4885, 0, NULL, NULL),
(204, 4885, '¡Bienvenidos a BoomBang!', 1, 4738, 0, NULL, NULL),
(205, 4871, '¡Bienvenidos a BoomBang!', 1, 4808, 0, NULL, NULL),
(206, 4808, '¡Bienvenidos a BoomBang!', 1, 4871, 0, NULL, NULL),
(207, 4884, '¡Bienvenidos a BoomBang!', 1, 4725, 1, NULL, NULL),
(208, 4871, '¡Bienvenidos a BoomBang!', 1, 4725, 0, NULL, NULL),
(209, 4725, '¡Bienvenidos a BoomBang!', 1, 4871, 0, NULL, NULL),
(210, 4871, '¡Bienvenidos a BoomBang!', 1, 4888, 0, NULL, NULL),
(211, 4888, '¡Bienvenidos a BoomBang!', 1, 4871, 0, NULL, NULL),
(212, 4470, '¡Bienvenidos a BoomBang!', 1, 4738, 0, NULL, NULL),
(213, 4738, '', 2, 4470, 0, NULL, NULL),
(214, 4886, '¡Bienvenidos a BoomBang!', 1, 4888, 1, NULL, NULL),
(215, 4471, '¡Bienvenidos a BoomBang!', 1, 4891, 0, NULL, NULL),
(216, 4891, '¡Bienvenidos a BoomBang!', 1, 4471, 0, NULL, NULL),
(218, 4470, '¡Bienvenidos a BoomBang!', 1, 4894, 0, NULL, NULL),
(219, 4894, '¡Bienvenidos a BoomBang!', 1, 4470, 0, NULL, NULL),
(220, 4644, '¡Bienvenidos a BoomBang!', 1, 4895, 0, NULL, NULL),
(221, 4895, '¡Bienvenidos a BoomBang!', 1, 4644, 0, NULL, NULL),
(222, 4895, '¡Bienvenidos a BoomBang!', 1, 4897, 0, NULL, NULL),
(223, 4956, '¡Bienvenidos a BoomBang!', 1, 4957, 0, NULL, NULL),
(224, 4957, '¡Bienvenidos a BoomBang!', 1, 4956, 0, NULL, NULL),
(225, 4790, '¡Bienvenidos a BoomBang!', 1, 4725, 0, NULL, NULL),
(226, 4725, '¡Bienvenidos a BoomBang!', 1, 4790, 0, NULL, NULL),
(227, 4897, '¡Bienvenidos a BoomBang!', 1, 4895, 0, NULL, NULL),
(228, 4897, '¡Bienvenidos a BoomBang!', 1, 4891, 0, NULL, NULL),
(229, 4891, '¡Bienvenidos a BoomBang!', 1, 4897, 0, NULL, NULL),
(230, 4987, '¡Bienvenidos a BoomBang!', 1, 4435, 0, NULL, NULL),
(231, 4435, '¡Bienvenidos a BoomBang!', 1, 4987, 0, NULL, NULL),
(234, 4471, '¡Bienvenidos a BoomBang!', 1, 4996, 0, NULL, NULL),
(235, 4996, '¡Bienvenidos a BoomBang!', 1, 4471, 0, NULL, NULL),
(236, 4435, '¡Bienvenidos a Yocomania!', 1, 4471, 0, '2021-01-18 15:54:36', '2021-01-18 15:54:49'),
(237, 4471, '¡Bienvenidos a Yocomania!', 1, 4435, 0, '2021-01-18 15:54:49', '2021-01-18 15:54:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bpad_mensajes`
--

CREATE TABLE `bpad_mensajes` (
  `id` int(11) NOT NULL,
  `Emisor` int(11) NOT NULL,
  `Mensaje` varchar(1500) NOT NULL,
  `Receptor` int(11) NOT NULL,
  `Tipo` int(11) NOT NULL DEFAULT 1,
  `Fecha` varchar(150) NOT NULL,
  `Leido` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bpad_mensajes`
--

INSERT INTO `bpad_mensajes` (`id`, `Emisor`, `Mensaje`, `Receptor`, `Tipo`, `Fecha`, `Leido`) VALUES
(6, 4464, 'posible bug', 4435, 0, '21/06/2020 12:53', 1),
(7, 4464, 'te cambias de colores y al entrar en area tienes los colores por defecto', 4435, 0, '21/06/2020 12:53', 1),
(8, 4464, 'pero eso pasa cuando me he puesto la piel negra, no se si con colores normales tb pasara', 4435, 0, '21/06/2020 12:53', 1),
(9, 4436, 'dejame entrar a ring cabron Xd', 4472, 0, '21/06/2020 18:29', 1),
(10, 4472, 'JAJAJAJA', 4436, 0, '21/06/2020 18:29', 1),
(11, 4436, 'mete solo 2 bots', 4472, 0, '21/06/2020 18:29', 1),
(12, 4472, 'okok\r', 4436, 0, '21/06/2020 18:29', 1),
(13, 4436, 'merci bro\r', 4472, 0, '21/06/2020 18:30', 1),
(14, 4472, 'pagaste?\r', 4436, 0, '21/06/2020 18:32', 1),
(15, 4436, 'ya xd', 4472, 0, '21/06/2020 18:32', 1),
(16, 4468, 'donde estas¿?\r', 4454, 0, '23/06/2020 22:54', 1),
(17, 4454, 'cementerio', 4468, 0, '23/06/2020 22:54', 1),
(18, 4468, 'pero que lugra pues', 4454, 0, '23/06/2020 22:54', 1),
(19, 4454, 'solo entra al área', 4468, 0, '23/06/2020 22:55', 1),
(20, 4468, 'ya entre \r', 4454, 0, '23/06/2020 22:56', 1),
(21, 4454, 'no te veo', 4468, 0, '23/06/2020 22:57', 1),
(22, 4468, 'esque nos pone lugares diferentes ', 4454, 0, '23/06/2020 22:57', 1),
(23, 4454, 'me llevó a otro lao', 4468, 0, '24/06/2020 1:07:', 1),
(24, 4454, 'iré a ver la Barbie, si quieres me escribes x discord c:<3', 4468, 0, '24/06/2020 1:22:', 1),
(25, 4519, 'ven', 4522, 0, '02/07/2020 1:37:', 1),
(26, 4489, 'Enqueandas?', 4471, 0, '26/07/2020 4:18:', 1),
(27, 4470, 'Cuanto tiempo...xD', 4435, 0, '05/08/2020 2:24:', 1),
(28, 4564, 'pp', 4558, 0, '07/08/2020 1:01:', 1),
(29, 4558, 'listo\r', 4564, 0, '07/08/2020 1:01:', 1),
(30, 4558, 'parece k hace falta mas gente\r', 4564, 0, '07/08/2020 1:02:', 1),
(31, 4470, 'Ya solo me faltan los chats ya que son los mas dificiles ya que no lo puedo hacer copiando y pegando ', 4435, 1, '13/09/2020 15:40', 1),
(32, 4651, 'party en mi isla :b\r', 4725, 0, '20/09/2020 20:32', 1),
(33, 4651, 'party en mi isla :b\r', 4802, 0, '20/09/2020 20:32', 1),
(34, 4651, 'party en mi isla :b\r', 4801, 0, '20/09/2020 20:32', 1),
(35, 4801, 'bruh4', 4651, 0, '20/09/2020 20:33', 1),
(36, 4804, 'q lag uwu', 4454, 0, '20/09/2020 20:52', 1),
(37, 4458, 'vn ps', 4468, 0, '21/09/2020 22:06', 1),
(38, 4458, 'dame la gata', 4468, 0, '21/09/2020 22:36', 1),
(39, 4468, 'donde estas\r', 4458, 1, '21/09/2020 22:36', 1),
(40, 4468, 'ven', 4458, 1, '21/09/2020 22:37', 1),
(41, 4489, 'mira wsp ', 4471, 0, '02/10/2020 23:38', 1),
(42, 4738, '3,1,2,1,1,3,1,1,3,1,1,1', 4737, 3, '03/10/2020 2:30:', 0),
(43, 4871, 'subiendo datos', 4808, 0, '03/10/2020 20:25', 1),
(44, 4808, 'XD', 4871, 0, '03/10/2020 20:26', 1),
(45, 4871, 'ven', 4808, 0, '03/10/2020 20:31', 1),
(46, 4888, 'tienes discord', 4871, 0, '03/10/2020 21:00', 1),
(47, 4888, 'subamos datos de beso', 4871, 0, '03/10/2020 21:02', 1),
(48, 4888, 'vmos bby<3', 4871, 0, '03/10/2020 21:07', 1),
(49, 4888, 'no entiendo los pasos *_*', 4871, 0, '03/10/2020 21:13', 1),
(50, 4888, 'ChukyIndica#4015\r\rese es mi discord', 4871, 0, '03/10/2020 21:25', 1),
(51, 4888, 'oye bb hablame al discord', 4871, 0, '03/10/2020 21:34', 1),
(52, 4871, 'ven', 4888, 0, '03/10/2020 21:35', 1),
(53, 4871, 'metete en yoco ahora bebe', 4888, 0, '03/10/2020 21:39', 1),
(54, 4895, '#Chinillo#0719', 4644, 0, '05/10/2020 5:00:', 1),
(55, 4957, 'hola hijo de puta\r', 4956, 0, '13/10/2020 15:40', 1),
(56, 4891, 'ven, que creo que con 1 persona no cae nada', 4471, 0, '20/10/2020 14:17', 1),
(57, 4891, 'bro entra a igloo que no cae nada', 4471, 0, '20/10/2020 14:21', 1),
(58, 4891, 'bro, si meto clon para que caegan cosas es motivo de ban?, que en igloo no cae nada', 4471, 0, '20/10/2020 14:28', 1),
(59, 4435, 'hola', 4987, 1, '02/11/2020 10:41', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_messages`
--

CREATE TABLE `chat_messages` (
  `chat_message_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` varchar(200) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `chat_messages`
--

INSERT INTO `chat_messages` (`chat_message_id`, `to_user_id`, `from_user_id`, `chat_message`, `timestamp`, `status`, `created_at`, `updated_at`) VALUES
(65, 4620, 4435, 'Hola', '2021-01-10 18:31:25', 1, '2021-01-10 17:31:25', '2021-01-10 17:31:25'),
(66, 4436, 4435, 'Hola', '2021-01-11 11:42:14', 1, '2021-01-11 10:42:14', '2021-01-11 10:42:14'),
(67, 4437, 4435, 'HOLA', '2021-01-19 07:48:05', 1, '2021-01-19 06:48:05', '2021-01-19 06:48:05'),
(68, 4620, 4435, 'cfgaf', '2021-01-19 18:35:04', 1, '2021-01-19 17:35:04', '2021-01-19 17:35:04'),
(69, 4471, 4435, 'hola', '2021-02-03 18:34:00', 0, '2021-01-28 16:55:17', '2021-02-03 17:34:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigos_promocionales`
--

CREATE TABLE `codigos_promocionales` (
  `id` int(11) NOT NULL,
  `codigo` varchar(12) NOT NULL,
  `oro` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concurso_objetos`
--

CREATE TABLE `concurso_objetos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `modelo` int(11) NOT NULL DEFAULT 0,
  `concurso_id` int(11) NOT NULL DEFAULT 0,
  `tipo_salida` int(11) NOT NULL DEFAULT 0 COMMENT '0 = Desvanecido rapido; 1 = ',
  `tipo_caida` int(11) NOT NULL DEFAULT 1,
  `tiempo` int(11) NOT NULL DEFAULT 3,
  `estado` int(11) NOT NULL DEFAULT 0,
  `borrar` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `concurso_objetos`
--

INSERT INTO `concurso_objetos` (`id`, `nombre`, `modelo`, `concurso_id`, `tipo_salida`, `tipo_caida`, `tiempo`, `estado`, `borrar`) VALUES
(1, 'cofre_oro', 1, 0, 1, 3, 3, 1, 1),
(2, 'cofre_plata', 2, 0, 1, 1, 3, 1, 1),
(3, 'cofre_plata', 2, 0, 1, 1, 3, 1, 1),
(4, 'cofre_plata', 2, 0, 1, 1, 3, 1, 1),
(5, 'coco', 20, 0, 0, 3, 3, 1, 1),
(6, 'shuriken', 78, 0, 0, 3, 3, 1, 1),
(7, 'fr_azul', 71, 0, 0, 3, 3, 1, 1),
(8, 'fr_lila', 72, 0, 0, 3, 3, 1, 1),
(9, 'fr_blanco', 73, 0, 0, 3, 3, 1, 1),
(10, 'fr_rojo', 74, 0, 0, 3, 3, 1, 1),
(11, 'fr_naranja', 75, 0, 0, 3, 3, 1, 1),
(12, 'fr_negro', 76, 0, 0, 3, 3, 1, 1),
(13, 'lapìda', 77, 0, 0, 3, 3, 1, 1),
(14, 'cerebro', 79, 0, 0, 3, 3, 1, 1),
(15, 'pie_azul', 80, 0, 0, 3, 3, 1, 1),
(16, 'pie_verde', 81, 0, 0, 3, 3, 1, 1),
(17, 'br_azul', 82, 0, 0, 3, 3, 1, 1),
(18, 'br_verde', 83, 0, 0, 3, 3, 1, 1),
(19, 'corazon', 84, 0, 0, 3, 3, 1, 1),
(20, 'sangre', 85, 0, 0, 3, 3, 1, 1),
(21, 'dentadura', 86, 0, 0, 3, 3, 1, 1),
(22, 'donut', 19, 0, 0, 3, 3, 1, 1),
(23, 'bolanieve', 13, 0, 0, 3, 3, 1, 1),
(24, 'setavenenosa', 141, 0, 0, 3, 3, 0, 1),
(25, 'corazon_valentin', 105, 0, 0, 3, 3, 0, 1),
(26, 'copo', 106, 0, 0, 3, 3, 0, 1),
(27, 'huevo', 202, 0, 0, 3, 3, 0, 1),
(28, 'calabaza', 89, 0, 0, 3, 3, 0, 1),
(29, 'caja_pocion', 6, 0, 0, 2, 6, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_desactivadas`
--

CREATE TABLE `cuentas_desactivadas` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(25) NOT NULL,
  `Fecha_Desactivacion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escenarios_favoritos`
--

CREATE TABLE `escenarios_favoritos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sala_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `escenarios_favoritos`
--

INSERT INTO `escenarios_favoritos` (`id`, `user_id`, `sala_id`) VALUES
(2, 4489, 317),
(3, 4577, 329),
(4, 4601, 334),
(5, 4489, 3877),
(6, 4489, 348);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escenarios_mgame`
--

CREATE TABLE `escenarios_mgame` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL DEFAULT 'mGame',
  `modelo` int(11) NOT NULL DEFAULT 0,
  `es_categoria` int(11) NOT NULL DEFAULT 2,
  `categoria` int(11) NOT NULL DEFAULT 5,
  `max_visitantes` int(11) NOT NULL DEFAULT 1,
  `uppert` int(11) NOT NULL DEFAULT 0,
  `coco` int(11) NOT NULL DEFAULT 0,
  `sub_escenarios` int(11) NOT NULL DEFAULT 1,
  `prioridad` int(11) NOT NULL DEFAULT 0,
  `Visible` int(11) NOT NULL DEFAULT 0,
  `IrAlli` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `escenarios_mgame`
--

INSERT INTO `escenarios_mgame` (`id`, `nombre`, `modelo`, `es_categoria`, `categoria`, `max_visitantes`, `uppert`, `coco`, `sub_escenarios`, `prioridad`, `Visible`, `IrAlli`) VALUES
(1, 'mGame', 1, 2, 5, 1, 0, 0, 1, 0, 0, 0),
(2, 'Ring', 2, 2, 5, 8, 0, 0, 1, 0, 0, 0),
(3, 'Ring', 3, 2, 5, 8, 0, 0, 1, 0, 0, 0),
(4, 'mGame', 7, 2, 5, 1, 0, 0, 1, 0, 0, 0),
(6, 'SenderoOculto', 6, 2, 5, 8, -1, 0, 1, 0, 0, 0),
(7, 'SenderoOculto', 7, 2, 5, 8, -1, 0, 1, 0, 0, 0),
(8, 'Cocos Locos', 8, 2, 5, 8, -1, 0, 1, 0, 0, 0),
(9, 'Cocos Locos', 9, 2, 5, 8, -1, 0, 1, 0, 0, 0),
(10, 'mGame', 10, 2, 5, 1, 0, 0, 1, 0, 0, 0),
(11, 'mGame', 11, 2, 5, 1, 0, 0, 1, 0, 0, 0),
(12, 'Camino Ninja', 12, 2, 5, 5, -1, -1, 1, 0, 0, 0),
(13, 'Camino Ninja', 13, 2, 5, 5, -1, -1, 1, 0, 0, 0),
(14, 'mGame', 14, 2, 5, 1, 0, 0, 1, 0, 0, 0),
(15, 'mGame', 15, 2, 5, 1, 0, 0, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escenarios_npc`
--

CREATE TABLE `escenarios_npc` (
  `id` int(11) NOT NULL,
  `Modelo` int(11) NOT NULL DEFAULT 0 COMMENT 'diseño',
  `dialogo` int(11) NOT NULL DEFAULT 0,
  `nombre` varchar(25) NOT NULL DEFAULT 'npc',
  `x` int(11) NOT NULL DEFAULT 11,
  `y` int(11) NOT NULL DEFAULT 11,
  `texto` int(11) NOT NULL DEFAULT 4,
  `function` int(11) NOT NULL DEFAULT 0,
  `function_value` int(11) NOT NULL DEFAULT 0,
  `ocupe` varchar(9000) NOT NULL,
  `EscenarioID` int(11) NOT NULL DEFAULT -1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `escenarios_npc`
--

INSERT INTO `escenarios_npc` (`id`, `Modelo`, `dialogo`, `nombre`, `x`, `y`, `texto`, `function`, `function_value`, `ocupe`, `EscenarioID`) VALUES
(12, 2, 0, 'npc2', 14, 16, 4, 15, 0, '', 55),
(13, 14, 0, 'npc14', 18, 14, 4, 5, 0, '', 26),
(14, 10, 0, 'npc10', 12, 19, 4, 16, 0, '', 38),
(15, 11, 0, 'npc11', 12, 14, 4, 4, 0, '', 46),
(16, 12, 0, 'npc12', 9, 12, 4, 2, 0, '', 50),
(17, 13, 17, 'npc13', 11, 9, 4, 3, 0, '', 30),
(18, 1, 0, 'npc1', 17, 15, 4, 17, 0, '', 52),
(19, 4, 0, 'npc4', 9, 16, 4, 18, 0, '', 63),
(20, 15, 0, 'npc15', 15, 16, 4, 19, 0, '', 64),
(21, 9, 0, 'npc9', 13, 16, 4, 21, 0, '', 71),
(22, 6, 0, 'npc6', 15, 13, 4, 11, 0, '', 95),
(23, 7, 0, 'npc7', 8, 14, 4, 14, 0, '', 83),
(24, 8, 0, 'npc8', 13, 16, 4, 13, 0, '', 86),
(26, 16, 0, 'npc16', 14, 17, 4, 12, 0, '', 84),
(27, 17, 0, 'npc17', 16, 14, 4, 25, 0, '', 87),
(28, 18, 0, 'npc18', 31, 28, 4, 27, 0, '', 19),
(30, 20, 0, 'npc3', 12, 9, 4, 0, 0, '', 1),
(31, 4, 0, 'baobau', 10, 13, 4, 1, 5, '', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escenarios_privados`
--

CREATE TABLE `escenarios_privados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `clave` varchar(30) NOT NULL,
  `modelo` int(11) NOT NULL DEFAULT 0,
  `es_categoria` int(11) NOT NULL DEFAULT 0,
  `categoria` int(11) NOT NULL DEFAULT 2,
  `max_visitantes` int(11) NOT NULL DEFAULT 12,
  `uppert` int(11) NOT NULL DEFAULT 0,
  `coco` int(11) NOT NULL DEFAULT 0,
  `visible` int(11) NOT NULL DEFAULT 1,
  `IslaID` int(11) NOT NULL DEFAULT 0,
  `color_1` varchar(1500) DEFAULT NULL,
  `color_2` varchar(1500) DEFAULT NULL,
  `terreno_something_1` varchar(500) NOT NULL,
  `terreno_something_2` varchar(500) NOT NULL,
  `terreno_something_3` varchar(500) NOT NULL,
  `terreno_config` varchar(500) NOT NULL,
  `terreno_colores` varchar(500) NOT NULL,
  `terreno_rgb` varchar(500) NOT NULL,
  `object_something_1` varchar(500) NOT NULL,
  `object_something_2` varchar(500) NOT NULL,
  `object_something_3` varchar(500) NOT NULL,
  `object_config` varchar(500) NOT NULL,
  `object_colores` varchar(500) NOT NULL,
  `object_rgb` varchar(500) NOT NULL,
  `puerta_1` int(11) NOT NULL DEFAULT -1,
  `puerta_2` int(11) NOT NULL DEFAULT -1,
  `puerta_3` int(11) NOT NULL DEFAULT -1,
  `puerta_4` int(11) NOT NULL DEFAULT -1,
  `puerta_5` int(11) NOT NULL DEFAULT -1,
  `puerta_6` int(11) NOT NULL DEFAULT -1,
  `puerta_7` int(11) NOT NULL DEFAULT -1,
  `puerta_8` int(11) NOT NULL DEFAULT -1,
  `puerta_9` int(11) NOT NULL DEFAULT -1,
  `puerta_10` int(11) NOT NULL DEFAULT -1,
  `puerta_11` int(11) NOT NULL DEFAULT -1,
  `puerta_12` int(11) NOT NULL DEFAULT -1,
  `puerta_13` int(11) NOT NULL DEFAULT -1,
  `puerta_14` int(11) NOT NULL DEFAULT -1,
  `puerta_15` int(11) NOT NULL DEFAULT -1,
  `puerta_16` int(11) NOT NULL DEFAULT -1,
  `CreadorID` int(11) NOT NULL DEFAULT 0,
  `IrAlli` int(11) NOT NULL DEFAULT 1,
  `Ultima_Sala` int(11) NOT NULL DEFAULT 0,
  `objeto_id` int(1) NOT NULL DEFAULT -1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `escenarios_privados`
--

INSERT INTO `escenarios_privados` (`id`, `nombre`, `clave`, `modelo`, `es_categoria`, `categoria`, `max_visitantes`, `uppert`, `coco`, `visible`, `IslaID`, `color_1`, `color_2`, `terreno_something_1`, `terreno_something_2`, `terreno_something_3`, `terreno_config`, `terreno_colores`, `terreno_rgb`, `object_something_1`, `object_something_2`, `object_something_3`, `object_config`, `object_colores`, `object_rgb`, `puerta_1`, `puerta_2`, `puerta_3`, `puerta_4`, `puerta_5`, `puerta_6`, `puerta_7`, `puerta_8`, `puerta_9`, `puerta_10`, `puerta_11`, `puerta_12`, `puerta_13`, `puerta_14`, `puerta_15`, `puerta_16`, `CreadorID`, `IrAlli`, `Ultima_Sala`, `objeto_id`) VALUES
(9080, 'Gen1', '', 25, 0, 4, 12, -1, 0, 1, 0, 'E0F8FFFFE5ADFFE5ADFFE5ADFAFBFFFAFBFFE6FF99FAFBFFE6FF99E6FF9987FF47E0DE8487FF47E0DE8487FF47E0DE8487FF47E0DE8487FF47E0DE846ED13FBF9A6B6ED13FBF9A6B6ED13FBF9A6B6ED13FBF9A6B6ED13FBF9A6BF4FFFFBF9963F4FFFFBF9963F4FFFFBF9963F4FFFFBF9963F4FFFFBF9963C8FF1BFFE8C2E9F8FFC1F9C4FFFBE1FCF2FFADFF671347FEFFAFE79657E0056D4EFFBFDCFFFBE1FFFBE1FF679AF2BD72F1FEE9FF694AFFE133F02FFFFFFBE1DD5D42961B1BE07C2DFAFFB3FFF41C8FFF50FFF741FFFBE1F7DDADBAA77CFFE6ABFFE6ABFFFBE1FFFFFFFF0000FF2831353231FF3F3FFF1913FFFFFFFFFFFFFF1B13ECE9EFFF40BFFF55C95CAAFFFF74F2C132C1000000FF4258', '63,74,100,91,56,100,91,56,100,91,56,100,71,73,100,71,73,100,80,42,100,71,73,100,80,42,100,80,42,100,63,17,100,88,45,100,63,17,100,88,45,100,63,17,100,88,45,100,63,17,100,88,45,100,63,17,100,88,45,100,62,19,79,100,53,49,62,19,79,100,53,49,62,19,79,100,53,49,62,19,79,100,53,49,62,19,79,100,53,49,68,72,100,103,50,75,68,72,100,103,50,75,68,72,100,103,50,75,68,72,100,103,50,75,68,72,100,103,50,75,91,5,100,86,61,100,66,74,100,62,58,98,77,65,100,73,76,100,70,26,100,120,25,100,90,88,100,70,119,88,77,65,100,89,81,100,77,65,100,77,65,100,115,87,100,105,49,95,77,65,100,126,62,100,111,24,100,99,129,100,77,65,100,125,62,87,135,72,59,127,45,88,82,51,100,109,14,100,64,20,100,103,23,100,77,65,100,90,58,97,91,55,73,91,55,100,91,55,100,77,65,100,72,72,100,143,68,100,137,75,100,77,71,21,130,72,100,143,70,100,72,72,100,72,72,100,143,69,100,72,74,94,116,109,100,111,105,100,30,97,100,96,106,100,101,122,76,73,75,0,129,79,100', '0', '0', '0,1,2,3,4,5,6,9', '6,10,11,12,13,14,25,28', 'E6FF99,E0DE8487FF47,E0DE8487FF47,E0DE8487FF47,E0DE8487FF47,E0DE8487FF47,C8FF1B,FFFBE1C1F9C4', '80,42,100.88,45,100,63,17,100.88,45,100,63,17,100.88,45,100,63,17,100.88,45,100,63,17,100.88,45,100,63,17,100.91,5,100.77,65,100,62,58,98', '1', '3', '10,11,12,13,14,15,16,17,18', '40,0,31,0,39,0,0,37,0', 'FCF2FF,000000,000000,000000,FF694AFFE133,000000,000000,FF679A,000000', '73,76,100.50,50,50.50,50,50.50,50,50.126,62,100,111,24,100.50,50,50.50,50,50.115,87,100.50,50,50', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5009, 1, 0, -1),
(9081, 'Gen1', '', 26, 0, 4, 12, -1, 0, 1, 0, 'DDD096F9EECAE8DEC5E8DACAEDE4BDF9F8CDFFF8D5F7EFB2E5D699F4E5CC', '88,53,87,82,62,98,80,64,91,80,67,91,82,60,93,79,60,98,80,62,100,85,55,97,89,53,90,82,64,96', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 5009, 1, 0, -1),
(9082, 'Gen1', '', 27, 0, 4, 12, -1, 0, 1, 0, 'ED6A1BD3D67EA88964FFA222FFFFFFFFE9CBD9F3FFFFFFFFFFFFFF', '135,46,93,86,44,84,98,55,66,127,34,100,72,72,100,85,63,100,61,76,100,72,72,100,72,72,100', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5009, 1, 0, -1),
(9083, 'Gen1', '', 28, 0, 4, 12, -1, 0, 1, 0, 'FFDF1C0C0A0A161210BC9C6956493BFF243BFF6318FFFFFF', '114,100,18,85,5,71,93,67,9,99,51,74,93,60,34,138,79,100,138,49,100,72,72,100', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5009, 1, 0, -1),
(9084, 'Gen1', '', 29, 0, 4, 12, -1, 0, 1, 0, 'FFA21CFFD01E9CA56DFFFFFFF7E1BAFFFFFFFFFFFFB27554FFCC3CED6F23FFFFFFFFFFFFFFFFFF', '128,32,100,118,22,100,81,48,65,72,72,100,86,60,97,72,72,100,72,72,100,110,57,70,114,31,100,132,47,93,72,72,100,72,72,100,72,72,100', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5009, 1, 0, -1),
(9085, 'Gen1', '', 30, 0, 4, 12, -1, 0, 1, 0, 'CCD1A5FFFBFBA09F8AFFFFFFFFFFFFF7DEA7', '78,58,82,73,72,100,77,63,63,72,72,100,72,72,100,91,56,97', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5009, 1, 0, -1),
(9086, 'Gen1', '', 31, 0, 4, 12, -1, 0, 1, 0, '', '', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5009, 1, 0, -1),
(9087, 'Gen1', '', 32, 0, 4, 12, -1, 0, 1, 0, 'FFFFFFB1DDB8E3FFBADFFFB1FFFFFFFFFFFFDEFFAAEAFFCFC9C39FFFFFFFFFFFFFFFFFFFFFFFFFD4C3FFFFFFFF', '72,72,100,62,60,87,74,51,100,74,49,100,72,72,100,72,72,100,75,47,100,73,58,100,82,59,79,72,72,100,72,72,100,72,72,100,72,72,100,68,90,100,72,72,100', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5009, 1, 0, -1),
(9088, 'Gen1', '', 33, 0, 4, 12, -1, 0, 1, 0, '', '', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5009, 1, 0, -1),
(9089, 'Gen1', '', 34, 0, 4, 12, -1, 0, 1, 0, '', '', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5009, 1, 0, -1),
(9090, 'Gen1', '', 35, 0, 4, 12, -1, 0, 1, 0, 'BFF45E665237E8E5DE', '79,96,25,101,51,40,74,70,91', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5009, 1, 0, -1),
(9091, 'Gen1', '', 36, 0, 4, 12, -1, 0, 1, 0, '', '', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5009, 1, 0, -1),
(9092, 'Gen1', '', 40, 0, 4, 12, -1, 0, 1, 0, 'F2FFE4F9FFE2FDFEFAABFFFBDFFFB1', '72,100,72,62,60,87,74,51,100,74,49,100,74,49,100', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5009, 1, 0, -1),
(9093, 'Gen1', '', 41, 0, 4, 12, -1, 0, 1, 0, 'FFDE5BAEC8DDFF4E5AFFDCA8', '72,72,100,62,60,100,74,51,100,74,49,100', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5009, 1, 0, -1),
(9094, 'Gen1', '', 42, 0, 4, 12, -1, 0, 1, 0, 'FFED33FAF6FFEFCFCF42EAFF9B8078FF3D2E6B4128FFE1C2FFEAD7A4FFF6FFFFFF', '72,72,100,62,60,87,74,51,100,74,49,100,72,72,100,72,72,100,75,47,100,73,58,100,82,59,79, 72,72,100,72,72,100', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5009, 1, 0, -1),
(9095, 'Gen1', '', 43, 0, 4, 12, -1, 0, 1, 0, 'FCFEE0A0997F', '72,72,100,62,60,87', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5009, 1, 0, -1),
(9096, 'Gen', '', 25, 0, 4, 12, -1, 0, 1, 0, 'E0F8FFFFE5ADFFE5ADFFE5ADFAFBFFFAFBFFE6FF99FAFBFFE6FF99E6FF9987FF47E0DE8487FF47E0DE8487FF47E0DE8487FF47E0DE8487FF47E0DE846ED13FBF9A6B6ED13FBF9A6B6ED13FBF9A6B6ED13FBF9A6B6ED13FBF9A6BF4FFFFBF9963F4FFFFBF9963F4FFFFBF9963F4FFFFBF9963F4FFFFBF9963C8FF1BFFE8C2E9F8FFC1F9C4FFFBE1FCF2FFADFF671347FEFFAFE79657E0056D4EFFBFDCFFFBE1FFFBE1FF679AF2BD72F1FEE9FF694AFFE133F02FFFFFFBE1DD5D42961B1BE07C2DFAFFB3FFF41C8FFF50FFF741FFFBE1F7DDADBAA77CFFE6ABFFE6ABFFFBE1FFFFFFFF0000FF2831353231FF3F3FFF1913FFFFFFFFFFFFFF1B13ECE9EFFF40BFFF55C95CAAFFFF74F2C132C1000000FF4258', '63,74,100,91,56,100,91,56,100,91,56,100,71,73,100,71,73,100,80,42,100,71,73,100,80,42,100,80,42,100,63,17,100,88,45,100,63,17,100,88,45,100,63,17,100,88,45,100,63,17,100,88,45,100,63,17,100,88,45,100,62,19,79,100,53,49,62,19,79,100,53,49,62,19,79,100,53,49,62,19,79,100,53,49,62,19,79,100,53,49,68,72,100,103,50,75,68,72,100,103,50,75,68,72,100,103,50,75,68,72,100,103,50,75,68,72,100,103,50,75,91,5,100,86,61,100,66,74,100,62,58,98,77,65,100,73,76,100,70,26,100,120,25,100,90,88,100,70,119,88,77,65,100,89,81,100,77,65,100,77,65,100,115,87,100,105,49,95,77,65,100,126,62,100,111,24,100,99,129,100,77,65,100,125,62,87,135,72,59,127,45,88,82,51,100,109,14,100,64,20,100,103,23,100,77,65,100,90,58,97,91,55,73,91,55,100,91,55,100,77,65,100,72,72,100,143,68,100,137,75,100,77,71,21,130,72,100,143,70,100,72,72,100,72,72,100,143,69,100,72,74,94,116,109,100,111,105,100,30,97,100,96,106,100,101,122,76,73,75,0,129,79,100', '0', '0', '0,1,2,3,4,5,6,9', '6,10,11,12,13,14,25,28', 'E6FF99,E0DE8487FF47,E0DE8487FF47,E0DE8487FF47,E0DE8487FF47,E0DE8487FF47,C8FF1B,FFFBE1C1F9C4', '80,42,100.88,45,100,63,17,100.88,45,100,63,17,100.88,45,100,63,17,100.88,45,100,63,17,100.88,45,100,63,17,100.91,5,100.77,65,100,62,58,98', '1', '3', '10,11,12,13,14,15,16,17,18', '40,0,31,0,39,0,0,37,0', 'FCF2FF,000000,000000,000000,FF694AFFE133,000000,000000,FF679A,000000', '73,76,100.50,50,50.50,50,50.50,50,50.126,62,100,111,24,100.50,50,50.50,50,50.115,87,100.50,50,50', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5008, 1, 0, -1),
(9097, 'Gen', '', 26, 0, 4, 12, -1, 0, 1, 0, 'DDD096F9EECAE8DEC5E8DACAEDE4BDF9F8CDFFF8D5F7EFB2E5D699F4E5CC', '88,53,87,82,62,98,80,64,91,80,67,91,82,60,93,79,60,98,80,62,100,85,55,97,89,53,90,82,64,96', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 5008, 1, 0, -1),
(9098, 'Gen', '', 27, 0, 4, 12, -1, 0, 1, 0, 'ED6A1BD3D67EA88964FFA222FFFFFFFFE9CBD9F3FFFFFFFFFFFFFF', '135,46,93,86,44,84,98,55,66,127,34,100,72,72,100,85,63,100,61,76,100,72,72,100,72,72,100', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5008, 1, 0, -1),
(9099, 'Gen', '', 28, 0, 4, 12, -1, 0, 1, 0, 'FFDF1C0C0A0A161210BC9C6956493BFF243BFF6318FFFFFF', '114,100,18,85,5,71,93,67,9,99,51,74,93,60,34,138,79,100,138,49,100,72,72,100', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5008, 1, 0, -1),
(9100, 'Gen', '', 29, 0, 4, 12, -1, 0, 1, 0, 'FFA21CFFD01E9CA56DFFFFFFF7E1BAFFFFFFFFFFFFB27554FFCC3CED6F23FFFFFFFFFFFFFFFFFF', '128,32,100,118,22,100,81,48,65,72,72,100,86,60,97,72,72,100,72,72,100,110,57,70,114,31,100,132,47,93,72,72,100,72,72,100,72,72,100', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5008, 1, 0, -1),
(9101, 'Gen', '', 30, 0, 4, 12, -1, 0, 1, 0, 'CCD1A5FFFBFBA09F8AFFFFFFFFFFFFF7DEA7', '78,58,82,73,72,100,77,63,63,72,72,100,72,72,100,91,56,97', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5008, 1, 0, -1),
(9102, 'Gen', '', 31, 0, 4, 12, -1, 0, 1, 0, '', '', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5008, 1, 0, -1),
(9103, 'Gen', '', 32, 0, 4, 12, -1, 0, 1, 0, 'FFFFFFB1DDB8E3FFBADFFFB1FFFFFFFFFFFFDEFFAAEAFFCFC9C39FFFFFFFFFFFFFFFFFFFFFFFFFD4C3FFFFFFFF', '72,72,100,62,60,87,74,51,100,74,49,100,72,72,100,72,72,100,75,47,100,73,58,100,82,59,79,72,72,100,72,72,100,72,72,100,72,72,100,68,90,100,72,72,100', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5008, 1, 0, -1),
(9104, 'Gen', '', 33, 0, 4, 12, -1, 0, 1, 0, '', '', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5008, 1, 0, -1),
(9105, 'Gen', '', 34, 0, 4, 12, -1, 0, 1, 0, '', '', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5008, 1, 0, -1),
(9106, 'Gen', '', 35, 0, 4, 12, -1, 0, 1, 0, 'BFF45E665237E8E5DE', '79,96,25,101,51,40,74,70,91', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5008, 1, 0, -1),
(9107, 'Gen', '', 36, 0, 4, 12, -1, 0, 1, 0, '', '', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5008, 1, 0, -1),
(9108, 'Gen', '', 40, 0, 4, 12, -1, 0, 1, 0, 'F2FFE4F9FFE2FDFEFAABFFFBDFFFB1', '72,100,72,62,60,87,74,51,100,74,49,100,74,49,100', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5008, 1, 0, -1),
(9109, 'Gen', '', 41, 0, 4, 12, -1, 0, 1, 0, 'FFDE5BAEC8DDFF4E5AFFDCA8', '72,72,100,62,60,100,74,51,100,74,49,100', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5008, 1, 0, -1),
(9110, 'Gen', '', 42, 0, 4, 12, -1, 0, 1, 0, 'FFED33FAF6FFEFCFCF42EAFF9B8078FF3D2E6B4128FFE1C2FFEAD7A4FFF6FFFFFF', '72,72,100,62,60,87,74,51,100,74,49,100,72,72,100,72,72,100,75,47,100,73,58,100,82,59,79, 72,72,100,72,72,100', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5008, 1, 0, -1),
(9111, 'Gen', '', 43, 0, 4, 12, -1, 0, 1, 0, 'FCFEE0A0997F', '72,72,100,62,60,87', '0', '0', '', '', '', '', '0', '0', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5008, 1, 0, -1),
(9112, 'fdsg', '', 3, 0, 2, 12, 0, 0, 1, 370, '15CCFE35D3FEFEF8D98B59371E5B11', '6,86,82,15,84,100,78,63,100,111,53,55,51,16,39', '', '', '', '', '', '', '', '', '', '', '', '', -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 5009, 1, 0, -1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escenarios_publicos`
--

CREATE TABLE `escenarios_publicos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `modelo` int(11) NOT NULL,
  `es_categoria` int(11) NOT NULL DEFAULT 1,
  `categoria` int(11) NOT NULL DEFAULT 1,
  `max_visitantes` int(11) NOT NULL DEFAULT 12,
  `uppert` int(11) NOT NULL DEFAULT 250,
  `coco` int(11) NOT NULL DEFAULT 25,
  `visible` int(11) NOT NULL DEFAULT 0,
  `Prioridad` int(11) NOT NULL,
  `sub_escenarios` int(11) NOT NULL DEFAULT 0,
  `proximo_evento` int(11) NOT NULL DEFAULT 0,
  `tiempo_evento` int(11) NOT NULL DEFAULT 0,
  `tipo_evento` int(11) NOT NULL DEFAULT 0,
  `ultimo_evento` int(11) NOT NULL DEFAULT 0,
  `item_evento_anio` int(11) NOT NULL DEFAULT 0,
  `loteria_semanal` int(11) NOT NULL DEFAULT 0,
  `ranking_semanal` int(11) NOT NULL DEFAULT 0,
  `IrAlli` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `escenarios_publicos`
--

INSERT INTO `escenarios_publicos` (`id`, `nombre`, `modelo`, `es_categoria`, `categoria`, `max_visitantes`, `uppert`, `coco`, `visible`, `Prioridad`, `sub_escenarios`, `proximo_evento`, `tiempo_evento`, `tipo_evento`, `ultimo_evento`, `item_evento_anio`, `loteria_semanal`, `ranking_semanal`, `IrAlli`) VALUES
(1, 'Beluga Beach', 1, 1, 1, 12, 0, 25, 1, 3, 1, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(2, 'U.F.O [Sin Efecto]', 2, 1, 1, 12, 0, 25, 1, 5, 1, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(3, 'MiniKong', 3, 1, 1, 12, 0, 25, 1, 6, 1, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(4, 'BaoBab', 4, 1, 1, 12, 0, 25, 1, 7, 1, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(5, 'MediaNoche', 5, 1, 1, 12, 0, 25, 1, 8, 1, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(6, 'Vértigo', 6, 1, 1, 12, 0, 25, 1, 12, 1, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(7, 'IceAge', 7, 1, 1, 12, 0, 25, 1, 13, 1, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(8, 'Aquarium', 8, 1, 1, 12, 0, 25, 1, 14, 1, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(9, 'Igloo [VIP]', 9, 1, 1, 12, 0, 25, 1, 15, 1, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(10, 'JungleLove', 10, 1, 1, 12, 0, 25, 1, 16, 1, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(11, 'Ryuu', 11, 1, 1, 12, 0, 25, 1, 17, 1, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(12, 'Laponia', 12, 1, 1, 12, 0, 25, 1, 18, 1, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(13, 'Ciénaga', 13, 1, 1, 12, 0, 25, 1, 19, 1, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(14, 'XiónMao', 14, 1, 1, 12, 0, 25, 1, 20, 1, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(15, 'Tarántula', 15, 1, 1, 12, 0, 25, 1, 21, 1, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(16, 'Skate Park', 16, 1, 1, 12, 0, 25, 1, 22, 1, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(17, 'Pengüin Máfia', 17, 1, 1, 12, 0, 25, 1, 23, 1, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(18, 'DinoLand', 18, 1, 1, 12, 0, 25, 1, 24, 1, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(19, 'Area 51', 19, 1, 1, 12, 0, 25, 1, 25, 1, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(26, 'Cementerio', 26, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(27, 'Cementerio', 27, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(28, 'Cementerio', 28, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(29, 'Cementerio', 29, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(30, 'Cementerio', 30, 1, 1, 12, -1, 25, 1, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(31, 'Cementerio', 31, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(32, 'Cementerio', 32, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(33, 'Cementerio', 33, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(34, 'Cementerio', 34, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(35, 'Cementerio', 35, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(36, 'Cementerio', 36, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(37, 'Cementerio', 37, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(38, 'Cementerio', 38, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(39, 'Cementerio', 39, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(40, 'Cementerio', 40, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(41, 'Cementerio', 41, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(42, 'Cementerio', 42, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(43, 'Cementerio', 43, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(44, 'Cementerio', 44, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(45, 'Cementerio', 45, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(46, 'Cementerio', 46, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(47, 'Cementerio', 47, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(48, 'Cementerio', 48, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(49, 'Cementerio', 49, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(50, 'Cementerio', 50, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(52, 'Cementerio', 52, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(55, 'Cementerio', 55, 1, 1, 12, -1, 25, 0, 10, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(57, 'BosqueNevado', 57, 1, 1, 12, -1, 25, 1, 9, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(58, 'BosqueNevado', 58, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(59, 'BosqueNevado', 59, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(60, 'BosqueNevado', 60, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(61, 'BosqueNevado', 61, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(62, 'BosqueNevado', 62, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(63, 'BosqueNevado', 63, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(64, 'BosqueNevado', 64, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(65, 'BosqueNevado', 65, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(66, 'BosqueNevado', 66, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(67, 'BosqueNevado', 67, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(68, 'BosqueNevado', 68, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(69, 'BosqueNevado', 69, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(70, 'BosqueNevado', 70, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(71, 'BosqueNevado', 71, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(72, 'BosqueNevado', 72, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(73, 'BosqueNevado', 73, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(74, 'BosqueNevado', 74, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(78, 'La Madriguera', 78, 1, 1, 12, -1, 25, 1, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(79, 'La Madriguera', 79, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(80, 'La Madriguera', 80, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(81, 'La Madriguera', 81, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(82, 'La Madriguera', 82, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(83, 'La Madriguera', 83, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(84, 'La Madriguera', 84, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(85, 'La Madriguera', 85, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(86, 'La Madriguera', 86, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(87, 'La Madriguera', 87, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(88, 'La Madriguera', 88, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(89, 'La Madriguera', 89, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(90, 'La Madriguera', 90, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(91, 'La Madriguera', 91, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(92, 'La Madriguera', 92, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(93, 'La Madriguera', 93, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(95, 'La Madriguera', 95, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(96, 'La Madriguera', 96, 1, 1, 12, -1, 25, 0, 8, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 0),
(102, 'Ring', 102, 2, 2, 12, -1, 25, 1, 26, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(103, 'SenderoOculto', 103, 6, 2, 12, -1, 25, 1, 103, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(104, 'CocosLocos', 104, 8, 2, 12, -1, 25, 1, 27, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(105, 'CaminoNinja', 105, 12, 2, 12, -1, 25, 1, 105, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(108, 'JardínSecreto', 108, 1, 1, 12, -1, 25, 0, 4, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(114, 'Inframundo', 114, 1, 1, 12, -1, 25, 0, 11, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(214, 'Isla Perdida', 214, 1, 1, 12, 250, 25, 1, 8, 1, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(215, 'Isla Perdida', 215, 1, 1, 12, 250, 25, 0, 0, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(216, 'Isla Perdida', 216, 1, 1, 12, 250, 25, 0, 0, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(217, 'Isla Perdida', 217, 1, 1, 12, 250, 25, 0, 0, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(218, 'Isla Perdida', 218, 1, 1, 12, 250, 25, 0, 0, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(219, 'Isla Perdida', 219, 1, 1, 12, 250, 25, 0, 0, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(220, 'Isla Perdida', 220, 1, 1, 12, 250, 25, 0, 0, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(222, 'Isla Perdida', 222, 1, 1, 12, 250, 25, 0, 0, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(223, 'Isla Perdida', 223, 1, 1, 12, 250, 25, 0, 0, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(224, 'Isla Perdida', 224, 1, 1, 12, 250, 25, 0, 0, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(225, 'Isla Perdida', 225, 1, 1, 12, 250, 25, 0, 0, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(226, 'Isla Perdida', 226, 1, 1, 12, 250, 25, 0, 0, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(227, 'Isla Perdida', 227, 1, 1, 12, 250, 25, 0, 0, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(228, 'Isla Perdida', 228, 1, 1, 12, 250, 25, 0, 0, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(229, 'Isla Perdida', 229, 1, 1, 12, 250, 25, 0, 0, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(230, 'Isla Perdida', 230, 1, 1, 12, 250, 25, 0, 0, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(231, 'Isla Perdida', 231, 1, 1, 12, 250, 25, 0, 0, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(232, 'Isla Perdida', 232, 1, 1, 12, 250, 25, 0, 0, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(233, 'Isla Perdida', 233, 1, 1, 12, 250, 25, 0, 0, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(234, 'Isla Perdida', 234, 1, 1, 12, 250, 25, 0, 0, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(235, 'Isla Perdida', 235, 1, 1, 12, 250, 25, 0, 0, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(236, 'Isla Perdida', 236, 1, 1, 12, 250, 25, 0, 0, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(237, 'Isla Perdida', 237, 1, 1, 12, 250, 25, 0, 0, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1),
(238, 'Isla Perdida', 238, 1, 1, 12, 250, 25, 0, 0, 0, 1626791939, 0, 0, 2, 0, 1626791938, 1626791939, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `islas`
--

CREATE TABLE `islas` (
  `id` int(11) NOT NULL,
  `modelo` int(11) NOT NULL,
  `uppert` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `descripcion` varchar(500) NOT NULL DEFAULT 'Haz uso de este espacio para describir tu isla!',
  `CreadorID` int(11) NOT NULL,
  `Especial` int(11) NOT NULL,
  `noverlo_1` varchar(233) NOT NULL,
  `noverlo_2` varchar(233) NOT NULL,
  `noverlo_3` varchar(233) NOT NULL,
  `noverlo_4` varchar(233) NOT NULL,
  `noverlo_5` varchar(233) NOT NULL,
  `noverlo_6` varchar(233) NOT NULL,
  `noverlo_7` varchar(233) NOT NULL,
  `noverlo_8` varchar(233) NOT NULL,
  `mamigos_1` varchar(233) NOT NULL,
  `mamigos_2` varchar(233) NOT NULL,
  `mamigos_3` varchar(233) NOT NULL,
  `mamigos_4` varchar(233) NOT NULL,
  `mamigos_5` varchar(233) NOT NULL,
  `mamigos_6` varchar(233) NOT NULL,
  `mamigos_7` varchar(233) NOT NULL,
  `mamigos_8` varchar(233) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `islas`
--

INSERT INTO `islas` (`id`, `modelo`, `uppert`, `nombre`, `descripcion`, `CreadorID`, `Especial`, `noverlo_1`, `noverlo_2`, `noverlo_3`, `noverlo_4`, `noverlo_5`, `noverlo_6`, `noverlo_7`, `noverlo_8`, `mamigos_1`, `mamigos_2`, `mamigos_3`, `mamigos_4`, `mamigos_5`, `mamigos_6`, `mamigos_7`, `mamigos_8`) VALUES
(311, 1, 0, 'Alibaba', 'Haz uso de este espacio para describir tu isla!', 4435, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(312, 4, 0, 'Lmao', 'Haz uso de este espacio para describir tu isla!', 4461, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(313, 1, 0, 'coque', 'Haz uso de este espacio para describir tu isla!', 4467, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(314, 1, 0, 'Golden', 'Haz uso de este espacio para describir tu isla!', 4447, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(315, 1, 0, '.', 'Haz uso de este espacio para describir tu isla!', 4456, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(316, 1, 0, 'sad', 'Haz uso de este espacio para describir tu isla!', 4468, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(317, 1, 0, 'Alibaba Land', 'Haz uso de este espacio para describir tu isla!', 4471, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(318, 1, 0, 'Mi Isla', 'Haz uso de este espacio para describir tu isla!', 4436, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(319, 1, 1, 'hola', 'Haz uso de este espacio para describir tu isla!', 4507, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(320, 1, 0, 'Isla Peruana', 'Haz uso de este espacio para describir tu isla!', 4519, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(321, 2, 0, 'XD', 'Haz uso de este espacio para describir tu isla!', 4523, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(322, 1, 0, 'TOMAS', 'Haz uso de este espacio para describir tu isla!', 4525, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(323, 4, 0, 'f', 'Haz uso de este espacio para describir tu isla!', 4529, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(324, 1, 0, 'bua', 'Haz uso de este espacio para describir tu isla!', 4489, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(325, 3, 1, 'IceTea', 'Haz uso de este espacio para describir tu isla!', 4532, 0, '', '', '', '', '', '', '', '', 'nkkl,', '', '', '', '', '', '', ''),
(326, 1, 1, 'isla xd', 'mi isla xd', 4558, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(327, 1, 1, 'Isla', 'Haz uso de este espacio para describir tu isla!', 4563, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(328, 1, 0, 'kokokopo', 'Haz uso de este espacio para describir tu isla!', 4572, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(329, 1, 1, 'cloud', 'Haz uso de este espacio para describir tu isla!', 4577, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(330, 1, 1, 'Joaquin', 'Haz uso de este espacio para describir tu isla!', 4582, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(331, 1, 0, 'Marcos', 'Haz uso de este espacio para describir tu isla!', 4557, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(332, 4, 1, 'ojkmolk,', 'Haz uso de este espacio para describir tu isla!', 4589, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(333, 1, 0, 'dfhj', 'Haz uso de este espacio para describir tu isla!', 4590, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(334, 1, 1, ':3', 'Haz uso de este espacio para describir tu isla!', 4591, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(335, 1, 0, 'asgasga', 'Haz uso de este espacio para describir tu isla!', 4592, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(336, 1, 0, 'Meow', 'Haz uso de este espacio para describir tu isla!', 4608, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(337, 1, 0, 'plantas', 'Haz uso de este espacio para describir tu isla!', 4572, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(338, 1, 0, 'wwqq', 'Haz uso de este espacio para describir tu isla!', 4572, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(339, 2, 0, 'arboles', 'Haz uso de este espacio para describir tu isla!', 4572, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(340, 1, 0, 'Nevachana', 'Haz uso de este espacio para describir tu isla!', 4616, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(343, 1, 0, 'asd', 'Haz uso de este espacio para describir tu isla!', 4641, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(346, 1, 0, 'fgdfg', 'Haz uso de este espacio para describir tu isla!', 4645, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(347, 1, 0, 'd', 'Haz uso de este espacio para describir tu isla!', 4676, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(348, 4, 0, 'Mini rares', 'Haz uso de este espacio para describir tu isla!', 4651, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(350, 1, 0, 'dsfsdffsdfssdf', 'Haz uso de este espacio para describir tu isla!', 4725, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(351, 1, 0, 'Joaquin.', 'Haz uso de este espacio para describir tu isla!', 4582, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(352, 1, 0, 'fasdfsdfdff', 'Haz uso de este espacio para describir tu isla!', 4435, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(353, 1, 0, 'sdfsadfsd', 'Haz uso de este espacio para describir tu isla!', 4435, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(354, 1, 0, 'leo', 'Haz uso de este espacio para describir tu isla!', 4785, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(355, 2, 0, 'sefefeffe', 'Haz uso de este espacio para describir tu isla!', 4790, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(356, 1, 1, '...', 'Haz uso de este espacio para describir tu isla!', 4454, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(357, 1, 0, ',', 'Haz uso de este espacio para describir tu isla!', 4458, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(358, 4, 0, 'BULI', 'Haz uso de este espacio para describir tu isla!', 4818, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(359, 1, 1, '$$$', 'Haz uso de este espacio para describir tu isla!', 4808, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(360, 1, 0, 'Islita', 'Haz uso de este espacio para describir tu isla!', 4846, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(361, 1, 1, 'xzvxv', 'Haz uso de este espacio para describir tu isla!', 4876, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(362, 1, 0, 'TDMOMT', 'Haz uso de este espacio para describir tu isla!', 4891, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(363, 1, 1, 'Ggs', 'Haz uso de este espacio para describir tu isla!', 4895, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(364, 2, 0, 'compro keko', 'compro y vendo keko me interesa negociar', 4897, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(365, 1, 1, 'nose', 'Haz uso de este espacio para describir tu isla!', 4644, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(366, 2, 0, 'Flower Power', 'Haz uso de este espacio para describir tu isla!', 4958, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(367, 1, 0, 'asdxshbfdvsdz', 'Haz uso de este espacio para describir tu isla!', 4960, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(368, 2, 0, 'Dedo', 'Haz uso de este espacio para describir tu isla!', 4961, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(369, 1, 0, 'Holaa', 'Haz uso de este espacio para describir tu isla!', 4907, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(370, 1, 0, 'fgsfg', 'Haz uso de este espacio para describir tu isla!', 5009, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_details`
--

CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mapas_mgame`
--

CREATE TABLE `mapas_mgame` (
  `id` int(11) NOT NULL,
  `mapa` text NOT NULL,
  `posX` int(11) NOT NULL DEFAULT 0,
  `posY` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mapas_mgame`
--

INSERT INTO `mapas_mgame` (`id`, `mapa`, `posX`, `posY`) VALUES
(2, '1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111100111111111111111\n1111111111000001111111111111\n1111111111000000111111111111\n1111111111100000011111111111\n1111111100000000001111111111\n1111111110000000000111111111\n1111111111000000000011111111\n1111111111100000000001111111\n1111111111100000000011111111\n1111111111110000000111111111\n1111111111111000001111111111\n1111111111111100011111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111', 11, 11),
(3, '1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111100111111111111111\n1111111111000001111111111111\n1111111111000000111111111111\n1111111111100000011111111111\n1111111100000000001111111111\n1111111110000000000111111111\n1111111111000000000011111111\n1111111111100000000001111111\n1111111111100000000011111111\n1111111111110000000111111111\n1111111111111000001111111111\n1111111111111100011111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111', 0, 0),
(5, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111001111111111111111\r\n1111111110000111111111111111\r\n1111111100000011111111111111\r\n1111111000000001111111111111\r\n1111111000000000111111111111\r\n1111111000000000011111111111\r\n1111111000000000001111111111\r\n1111110000000000001111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000111111111111\r\n1111111110000001111111111111\r\n1111111111000011111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111 ', 0, 0),
(6, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111001111111111111111\r\n1111111110000111111111111111\r\n1111111100000011111111111111\r\n1111111000000001111111111111\r\n1111111000000000111111111111\r\n1111111000000000011111111111\r\n1111111000000000001111111111\r\n1111110000000000001111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000111111111111\r\n1111111110000001111111111111\r\n1111111111000011111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111 ', 0, 0),
(7, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111001111111111111111\r\n1111111110000111111111111111\r\n1111111100000011111111111111\r\n1111111000000001111111111111\r\n1111111000000000111111111111\r\n1111111000000000011111111111\r\n1111111000000000001111111111\r\n1111110000000000001111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000111111111111\r\n1111111110000001111111111111\r\n1111111111000011111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111 ', 0, 0),
(8, '1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111100001111111111111\n1111111111100000111111111111\n1111111110000000011111111111\n1111111110000000001111111111\n1111111110000000000111111111\n1111111000000000000011111111\n1111111000000000000111111111\n1111111100000000000111111111\n1111111110000000000111111111\n1111111110000000001111111111\n1111111110000000011111111111\n1111111110000000111111111111\n1111111111000001111111111111\n1111111111110011111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111', 0, 0),
(9, '1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111100001111111111111\n1111111111100000111111111111\n1111111110000000011111111111\n1111111110000000001111111111\n1111111110000000000111111111\n1111111000000000000011111111\n1111111000000000000111111111\n1111111100000000000111111111\n1111111110000000000111111111\n1111111110000000001111111111\n1111111110000000011111111111\n1111111110000000111111111111\n1111111111000001111111111111\n1111111111110011111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111', 0, 0),
(12, '1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111011111111111111111111\n1111111101111111111111111111\n1111111110111111111111111111\n1111111111011111111111111111\n1111111111101111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111', 0, 0),
(13, '1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111011111111111111111111\n1111111101111111111111111111\n1111111110111111111111111111\n1111111111011111111111111111\n1111111111101111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mapas_privados`
--

CREATE TABLE `mapas_privados` (
  `id` int(11) NOT NULL,
  `mapa` text NOT NULL,
  `posX` int(11) NOT NULL DEFAULT 11,
  `posY` int(11) NOT NULL DEFAULT 11
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mapas_privados`
--

INSERT INTO `mapas_privados` (`id`, `mapa`, `posX`, `posY`) VALUES
(1, '111111111111111111111111111111111\n111111111111111111111111111111111\n110111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111110011111111111111111111111111\n111111000111111111222111111111111\n111111111111111110022211111111111\n111113333333101100002221111111111\n111133311311000000000221111111111\n111113311100000000000011111111111\n111111310000000000000111111111111\n111111100000000000001111111111111\n111111110000000000001111111111111\n111111111000000000021111111111111\n111111111100000000222111111111111\n111111111110000002222211111111111\n111111111111000022222111111111111\n111111111111100222221111111111111\n111111111111112222211111111111111\n111111111111111222111111111111111\n111111111111111121111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111', 17, 15),
(2, '111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111112111111111111111\n111111111111111122111111111111111\n111111111111110022111111111111111\n111111111000000002211111111111111\n111111110000000000211111111111111\n111111100000000000111111111111111\n111111000000000000011111111111111\n111110000000000000011111111111111\n111100000000000000011111111111111\n111110000000000000011111111111111\n111111000000000000001111111111111\n111111100000000000001111111111111\n111111110000000000001111111111111\n111111111000000000022111111111111\n111111111100000000222211111111111\n111111111110000002222211111111111\n111111111111000022222111111111111\n111111111111100222221111111111111\n111111111111112222211111111111111\n111111111111111222111111111111111\n111111111111111121111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111', 9, 13),
(3, '111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111113311111111111111111\n111111111111133333111111111111111\n111111111111311333311111111111111\n111111111113301133331111111111111\n111111111133300013333111111111111\n111111111113300003333311111111111\n111111111111100001333331111111111\n111111111011000000133333111111111\n111111110000000000033333311111111\n111113310000000000003333111111111\n111133310000000000001331111111111\n111113300000000000000111111111111\n111111300000000000000111111111111\n111111100000000000001111111111111\n111111110000000000001111111111111\n111111111000000000022111111111111\n111111111100000000222211111111111\n111111111110000000222211111111111\n111111111111000000222111111111111\n111111111111100200021111111111111\n111111111111112220211111111111111\n111111111111111222111111111111111\n111111111111111121111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111', 9, 14),
(4, '111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111112211111111111111111\n111111111111122221111111111111111\n111111111111022221111111111111111\n111111111110002222111111111111111\n111111111100000222211111111111111\n111111111000000022221111111111111\n111111110000000002222111111111111\n111111100000000000222211111111111\n111111000000000000022111111111111\n111110000000000000001331111111111\n111100000000000000013333111111111\n111110000000000000013331111111111\n111111000000000000133311111111111\n111111100000000000133111111111111\n111111110000000000013111111111111\n111111111000000000013311111111111\n111111111100000000221331111111111\n111111111110000002222111111111111\n111111111111000022222111111111111\n111111111111100222221111111111111\n111111111111112222211111111111111\n111111111111111222111111111111111\n111111111111111121111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111\n111111111111111111111111111111111', 12, 12),
(5, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111212211111111111111\r\n111111111111112122211311111111111\r\n111111111111121222113331111111111\r\n111111111111012222133311111111111\r\n111111111111102221331333311111111\r\n111111111111110221331331331111111\r\n111111111110011111333333333111111\r\n111111111100000101333333333311111\r\n111111111000000000133333333111111\r\n111111110000000000133333331111111\r\n111111110000000000011333311111111\r\n111111100000000000000111111111111\r\n111111000000000000000011111111111\r\n111111000000000000000111111111111\r\n111111100000000000001111111111111\r\n111111110000000000001111111111111\r\n111111111000000000022111111111111\r\n111111111100000000222211111111111\r\n111111111110000002222211111111111\r\n111111111111000022222111111111111\r\n111111111111100222221111111111111\r\n111111111111112222211111111111111\r\n111111111111111222111111111111111\r\n111111111111111121111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 12, 12),
(6, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111113111111111111111\r\n111111111111111213113311111111111\r\n111111111111112211313331111111111\r\n111111111111122221111113111111111\r\n111111111111022222131111111111111\r\n111111111110002222133131131111111\r\n111111111100000222213111013111111\r\n111111111000000022213331101311111\r\n111111110000000002221331111111111\r\n111111100000000000222131111111111\r\n111111000000000000011133111111111\r\n111110000000000000001133111111111\r\n111110000000000000000131111111111\r\n111110000000000000000011111111111\r\n111111000000000000000011111111111\r\n111111100000000000000111111111111\r\n111111110000000010001111111111111\r\n111111111000000011022111111111111\r\n111111111100000001222211111111111\r\n111111111110000002222211111111111\r\n111111111111000022222111111111111\r\n111111111111100222221111111111111\r\n111111111111112222211111111111111\r\n111111111111111222111111111111111\r\n111111111111111121111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 12, 10),
(7, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111011111111111111111111\r\n111111111110011111111111111111111\r\n111111111100011111111111111111111\r\n111111111000011111111111111111111\r\n111111110000001111111111111111111\r\n111111100000000000111111111111111\r\n111111000000000000011111111111111\r\n111111000000000000001111111111111\r\n111111000000000000000111111111111\r\n111111000000000000000011111111111\r\n111111000000000000000011111111111\r\n111111100000000000000111111111111\r\n111111110000000000002111111111111\r\n111111111000000000022211111111111\r\n111111111100000000222221111111111\r\n111111111110000002222211111111111\r\n111111111111000022222111111111111\r\n111111111111100222221111111111111\r\n111111111111112222211111111111111\r\n111111111111111222111111111111111\r\n111111111111111121111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 18, 17),
(8, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111011111111111111111111\r\n111111111110011111111111111111111\r\n111111111100011111111111111111111\r\n111111111000011111111111111111111\r\n111111110000001111111111111111111\r\n111111100000000000111111111111111\r\n111111000000000000011111111111111\r\n111111000000000000001111111111111\r\n111111000000000000000111111111111\r\n111111000000000000000011111111111\r\n111111000000000000000011111111111\r\n111111100000000000000111111111111\r\n111111110000000000002111111111111\r\n111111111000000000022211111111111\r\n111111111100000000222221111111111\r\n111111111110000002222211111111111\r\n111111111111000022222111111111111\r\n111111111111100222221111111111111\r\n111111111111112222211111111111111\r\n111111111111111222111111111111111\r\n111111111111111121111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 18, 17),
(9, '111111111111111111111111111111111\r\n100000000000000000000000000000000\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111111122111111111111111110\r\n101111111111002133111111111111110\r\n101111111110000213311111111111110\r\n101111111100000021331111111111110\r\n101111111000000002131111111111110\r\n101111110000000000133111111111110\r\n101111100000000000013311111111110\r\n101111000000000000001333111111110\r\n101110000000000000000113111111110\r\n101110000000000010000011111111110\r\n101111000000000031000011111111110\r\n101111100000000000000111111111110\r\n101111110000000000001111111111110\r\n101111111000000000022111111111110\r\n101111111100000000222211111111110\r\n101111111110000002222211111111110\r\n101111111111000022222111111111110\r\n101111111111100222221111111111110\r\n101111111111112222211111111111110\r\n101111111111111222111111111111110\r\n101111111111111121111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n100000000000000000000000000000000', 11, 13),
(10, '111111111111111111111111111111111\r\n100000000000000000000000000000000\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111100011111111111111111110\r\n101111111000000111111111111111110\r\n101111110000000011111111111111110\r\n101111100000000001111111111111110\r\n101111000000000000111111111111110\r\n101110000000000000011111111111110\r\n101110000000000000001111111111110\r\n101111000000000000001111111111110\r\n101111100000000000001111111111110\r\n101111110000000000001111111111110\r\n101111111000000000022111111111110\r\n101111111100000000222211111111110\r\n101111111110000002222211111111110\r\n101111111111000022222111111111110\r\n101111111111100222221111111111110\r\n101111111111112222211111111111110\r\n101111111111111222111111111111110\r\n101111111111111121111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n100000000000000000000000000000000', 14, 13),
(11, '111111111111111111111111111111111\r\n100000000000000000000000000000000\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n101111111110011111111111111111110\r\n101111100000001011111111111111110\r\n101111000000001111111111111111110\r\n101110000000000111111111111111110\r\n101110000000000000011111111111110\r\n101111000000000000011111111111110\r\n101111100000000000011111111111110\r\n101111110000000000011111111111110\r\n101111111000000000022111111111110\r\n101111111100000000222211111111110\r\n101111111110000002222211111111110\r\n101111111111000022222111111111110\r\n101111111111100222221111111111110\r\n101111111111112222211111111111110\r\n101111111111111222111111111111110\r\n101111111111111121111111111111110\r\n101111111111111111111111111111110\r\n101111111111111111111111111111110\r\n100000000000000000000000000000000', 10, 15),
(12, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111021111111111111111111\r\n111111111110002111111111111111111\r\n111111111100000211111111111111111\r\n111111111000000021111111111111111\r\n111111110000000002111111111111111\r\n111111100100000000211111111111111\r\n111111001100000000021111111111111\r\n111111111000000000002111111111111\r\n111111110000000000000111111111111\r\n111111100000000000000111111111111\r\n111111100000000000000111111111111\r\n111111100000000000000111111111111\r\n111111110000000000002111111111111\r\n111111111000000000022111111111111\r\n111111111100000000222211111111111\r\n111111111110000002222211111111111\r\n111111111111000022222111111111111\r\n111111111111100222221111111111111\r\n111111111111112222211111111111111\r\n111111111111111222111111111111111\r\n111111111111111121111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 17, 15),
(13, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111011111111111111111111\r\n111111111110001111111111111111111\r\n111111111100000111111111111111111\r\n111111111000000011111111111111111\r\n111111110000000001111111111111111\r\n111111100000000000111111111111111\r\n111111000000000001111111111111111\r\n111110000000000000111111111111111\r\n111110000000000000001111111111111\r\n111111000000000000000111111111111\r\n111111000000000000000111111111111\r\n111111100000000000000111111111111\r\n111111110000000000002111111111111\r\n111111111000000000022211111111111\r\n111111111100000000222221111111111\r\n111111111110000002222211111111111\r\n111111111111000022222111111111111\r\n111111111111100222221111111111111\r\n111111111111112222211111111111111\r\n111111111111111222111111111111111\r\n111111111111111121111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 11, 12),
(14, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111011111111111111111111\r\n111111111110011111111111111111111\r\n111111111100011111111111111111111\r\n111111111000011111111111111111111\r\n111111110000001111111111111111111\r\n111111100000000000111111111111111\r\n111111000000000000011111111111111\r\n111111000000000000001111111111111\r\n111111000000000000000111111111111\r\n111111000000000000000011111111111\r\n111111000000000000000011111111111\r\n111111100000000000000111111111111\r\n111111110000000000002111111111111\r\n111111111000000000022211111111111\r\n111111111100000000222221111111111\r\n111111111110000002222211111111111\r\n111111111111000022222111111111111\r\n111111111111100222221111111111111\r\n111111111111112222211111111111111\r\n111111111111111222111111111111111\r\n111111111111111121111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 17, 15),
(15, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111011111111111111111111\r\n111111111110011111111111111111111\r\n111111111100011111111111111111111\r\n111111111000011111111111111111111\r\n111111110000001111111111111111111\r\n111111100000000000111111111111111\r\n111111000000000000011111111111111\r\n111111000000000000001111111111111\r\n111111000000000000000111111111111\r\n111111000000000000000011111111111\r\n111111000000000000000011111111111\r\n111111100000000000000111111111111\r\n111111110000000000002111111111111\r\n111111111000000000022211111111111\r\n111111111100000000222221111111111\r\n111111111110000002222211111111111\r\n111111111111000022222111111111111\r\n111111111111100222221111111111111\r\n111111111111112222211111111111111\r\n111111111111111222111111111111111\r\n111111111111111121111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 18, 17),
(16, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111011111111111111111111\r\n111111111110011111111111111111111\r\n111111111100011111111111111111111\r\n111111111000011111111111111111111\r\n111111110000001111111111111111111\r\n111111100000000000111111111111111\r\n111111000000000000011111111111111\r\n111111000000000000001111111111111\r\n111111000000000000000111111111111\r\n111111000000000000000011111111111\r\n111111000000000000000011111111111\r\n111111100000000000000111111111111\r\n111111110000000000002111111111111\r\n111111111000000000022211111111111\r\n111111111100000000222221111111111\r\n111111111110000002222211111111111\r\n111111111111000022222111111111111\r\n111111111111100222221111111111111\r\n111111111111112222211111111111111\r\n111111111111111222111111111111111\r\n111111111111111121111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 17, 15),
(17, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111011111111111111111111\r\n111111111110011111111111111111111\r\n111111111100011111111111111111111\r\n111111111000011111111111111111111\r\n111111110000001111111111111111111\r\n111111100000000000111111111111111\r\n111111000000000000011111111111111\r\n111111000000000000001111111111111\r\n111111000000000000000111111111111\r\n111111000000000000000011111111111\r\n111111000000000000000011111111111\r\n111111100000000000000111111111111\r\n111111110000000000002111111111111\r\n111111111000000000022211111111111\r\n111111111100000000222221111111111\r\n111111111110000002222211111111111\r\n111111111111000022222111111111111\r\n111111111111100222221111111111111\r\n111111111111112222211111111111111\r\n111111111111111222111111111111111\r\n111111111111111121111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 17, 21),
(18, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111011111111111111111111\r\n111111111110011111111111111111111\r\n111111111100011111111111111111111\r\n111111111000011111111111111111111\r\n111111110000001111111111111111111\r\n111111100000000000111111111111111\r\n111111000000000000011111111111111\r\n111111000000000000001111111111111\r\n111111000000000000000111111111111\r\n111111000000000000000011111111111\r\n111111000000000000000011111111111\r\n111111100000000000000111111111111\r\n111111110000000000002111111111111\r\n111111111000000000022211111111111\r\n111111111100000000222221111111111\r\n111111111110000002222211111111111\r\n111111111111000022222111111111111\r\n111111111111100222221111111111111\r\n111111111111112222211111111111111\r\n111111111111111222111111111111111\r\n111111111111111121111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 8, 18),
(19, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111011111111111111111111\r\n111111111110011111111111111111111\r\n111111111100011111111111111111111\r\n111111111000011111111111111111111\r\n111111110000001111111111111111111\r\n111111100000000000111111111111111\r\n111111000000000000011111111111111\r\n111111000000000000001111111111111\r\n111111000000000000000111111111111\r\n111111000000000000000011111111111\r\n111111000000000000000011111111111\r\n111111100000000000000111111111111\r\n111111110000000000002111111111111\r\n111111111000000000022211111111111\r\n111111111100000000222221111111111\r\n111111111110000002222211111111111\r\n111111111111000022222111111111111\r\n111111111111100222221111111111111\r\n111111111111112222211111111111111\r\n111111111111111222111111111111111\r\n111111111111111121111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 16, 17),
(20, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111011111111111111111111\r\n111111111110011111111111111111111\r\n111111111100011111111111111111111\r\n111111111000011111111111111111111\r\n111111110000001111111111111111111\r\n111111100000000000111111111111111\r\n111111000000000000011111111111111\r\n111111000000000000001111111111111\r\n111111000000000000000111111111111\r\n111111000000000000000011111111111\r\n111111000000000000000011111111111\r\n111111100000000000000111111111111\r\n111111110000000000002111111111111\r\n111111111000000000022211111111111\r\n111111111100000000222221111111111\r\n111111111110000002222211111111111\r\n111111111111000022222111111111111\r\n111111111111100222221111111111111\r\n111111111111112222211111111111111\r\n111111111111111222111111111111111\r\n111111111111111121111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 15, 20),
(21, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111100111111111111111111\r\n111111111111100011111111111111111\r\n111111111111110000111111111111111\r\n111111111111111101011111111111111\r\n111111111111111111111111111111111\r\n111111110001111111111111111111111\r\n111111110000111111111111111111111\r\n111111100000111111111111111111111\r\n111111100000111111111111111111111\r\n111111100000001111111111111111111\r\n111111100000000011111111111111111\r\n111111110000000000111111111111111\r\n111111111000000000111111111111111\r\n111111111100000000111111111111111\r\n111111111110000000111111111111111\r\n111111111111000002111111111111111\r\n111111111111110022111111111111111\r\n111111111111111122111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 9, 15),
(22, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111011111111111111111111\r\n111111111110011111111111111111111\r\n111111111100011111111111111111111\r\n111111111000011111111111111111111\r\n111111110000001111111111111111111\r\n111111100000000000111111111111111\r\n111111000000000000011111111111111\r\n111111000000000000001111111111111\r\n111111000000000000000111111111111\r\n111111000000000000000011111111111\r\n111111000000000000000011111111111\r\n111111100000000000000111111111111\r\n111111110000000000002111111111111\r\n111111111000000000022211111111111\r\n111111111100000000222221111111111\r\n111111111110000002222211111111111\r\n111111111111000022222111111111111\r\n111111111111100222221111111111111\r\n111111111111112222211111111111111\r\n111111111111111222111111111111111\r\n111111111111111121111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 17, 21),
(23, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111100111111111111111111\r\n111111111111100011111111111111111\r\n111111111111110000111111111111111\r\n111111111111111101011111111111111\r\n111111111111111111111111111111111\r\n111111110001111111111111111111111\r\n111111110000111111111111111111111\r\n111111100000111111111111111111111\r\n111111100000111111111111111111111\r\n111111100000001111111111111111111\r\n111111100000000011111111111111111\r\n111111110000000000111111111111111\r\n111111111000000000111111111111111\r\n111111111100000000111111111111111\r\n111111111110000000111111111111111\r\n111111111111000002111111111111111\r\n111111111111110022111111111111111\r\n111111111111111122111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 9, 15),
(24, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111100111111111111111111\r\n111111111111100011111111111111111\r\n111111111111110000111111111111111\r\n111111111111111101011111111111111\r\n111111111111111111111111111111111\r\n111111110001111111111111111111111\r\n111111110000111111111111111111111\r\n111111100000111111111111111111111\r\n111111100000111111111111111111111\r\n111111100000001111111111111111111\r\n111111100000000011111111111111111\r\n111111110000000000111111111111111\r\n111111111000000000111111111111111\r\n111111111100000000111111111111111\r\n111111111110000000111111111111111\r\n111111111111000002111111111111111\r\n111111111111110022111111111111111\r\n111111111111111122111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 12, 19),
(25, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111100111111111111111111\r\n111111111111000111111111111111111\r\n111111111110000111111111111111111\r\n111111111100000111111111111111111\r\n111111111000000011111111111111111\r\n111111110000000000011111111111111\r\n111111133000000000111011111111111\r\n111111300000000000000001111111111\r\n111110000000000000000001111111111\r\n111110000000000000000001111111111\r\n111111000000000000000001111111111\r\n111111100000000000000011111111111\r\n111111110000000000000111111111111\r\n111111111000000000001111111111111\r\n111111111100000000022111111111111\r\n111111111110000000222211111111111\r\n111111111111000002222211111111111\r\n111111111111100022222111111111111\r\n111111111111110222221111111111111\r\n111111111111112222211111111111111\r\n111111111111111222111111111111111\r\n111111111111111121111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 18, 15),
(26, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111100111111111111111111\r\n111111111111100011111111111111111\r\n111111111111110000111111111111111\r\n111111111111111101011111111111111\r\n111111111111111111111111111111111\r\n111111110001111111111111111111111\r\n111111110000111111111111111111111\r\n111111100000111111111111111111111\r\n111111100000111111111111111111111\r\n111111100000001111111111111111111\r\n111111100000000011111111111111111\r\n111111110000000000111111111111111\r\n111111111000000000111111111111111\r\n111111111100000000111111111111111\r\n111111111110000000111111111111111\r\n111111111111000002111111111111111\r\n111111111111110022111111111111111\r\n111111111111111122111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 9, 15),
(27, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111100111111111111111111111\r\n111111111000011111111111111111111\r\n111111110000011111111111111111111\r\n111111110000001111111111111111111\r\n111111110000001111111111111111111\r\n111111110000000111111111111111111\r\n111111111000000011111111111111111\r\n111111111100000011111111111111111\r\n111111111110000011111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 15, 21),
(28, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111000001111111111111111111\r\n111111111000000011111111111111111\r\n111111110000000011111111111111111\r\n111111110000000011111111111111111\r\n111111111000000011111111111111111\r\n111111111000000011111111111111111\r\n111111111100000011111111111111111\r\n111111111111001111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 9, 17),
(29, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111100011111111111111111111\r\n111111111100000111111111111111111\r\n111111111100000001111111111111111\r\n111111111000000001111111111111111\r\n111111111000000001111111111111111\r\n111111111000000001111111111111111\r\n111111111000000001111111111111111\r\n111111111000000001111111111111111\r\n111111111000000000111111111111111\r\n111111111000000000011111111111111\r\n111111111100000000211111111111111\r\n111111111110000002211111111111111\r\n111111111111100022211111111111111\r\n111111111111111122111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 9, 20),
(30, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111000111111111111111111\r\n111111111110000001111111111111111\r\n111111111100000000111111111111111\r\n111111111100000000011111111111111\r\n111111111100000000011111111111111\r\n111111111100000000011111111111111\r\n111111111110000000001111111111111\r\n111111111110000000011111111111111\r\n111111111111000000011111111111111\r\n111111111111100000111111111111111\r\n111111111111110001111111111111111\r\n111111111111100000111111111111111\r\n111111111111100000111111111111111\r\n111111111111100000011111111111111\r\n111111111111100000111111111111111\r\n111111111111111000111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 10, 15),
(31, '111111111111111111111111111111111 \r\n111111111111111111111111111111111 \r\n111111111111111111111111111111111 \r\n111111111111111111111111111111111 \r\n111111111111111111111111111111111 \r\n111111111111111111111111111111111 \r\n111111111111111111111111111111111 \r\n111111111111111111111111111111111 \r\n111111111111111111111111111111111 \r\n111111111111111111111111111111111 \r\n111111111111111111111111111111111 \r\n111111111111111111111111111111111 \r\n111111111111111111111111111111111 \r\n111111111111111111111111111111111 \r\n111111111111111111111111111111111 \r\n111111111101001111111111111111111 \r\n111111111000000011111111111111111 \r\n111111110000000011111111111111111 \r\n111111110000000001111111111111111 \r\n111111110000000000111111111111111 \r\n111111110000000000111111111111111 \r\n111111110000000000011111111111111 \r\n111111111000000000011111111111111 \r\n111111111100000000111111111111111 \r\n111111111110000000111111111111111 \r\n111111111111010001111111111111111 \r\n111111111111111111111111111111111 \r\n111111111111111111111111111111111 \r\n111111111111111111111111111111111 \r\n111111111111111111111111111111111 \r\n111111111111111111111111111111111 \r\n111111111111111111111111111111111 \r\n111111111111111111111111111111111', 9, 17),
(32, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111100011111111111111111\r\n111111111111100000111111111111111\r\n111111111111100000111111111111111\r\n111111110000000000011111111111111\r\n111111100000000000011111111111111\r\n111111100000000000111111111111111\r\n111111100000000001111111111111111\r\n111111100000000000111111111111111\r\n111111110000000000111111111111111\r\n111111110000000000111111111111111\r\n111111111000000000111111111111111\r\n111111111100000000111111111111111\r\n111111111110000000111111111111111\r\n111111111111000001111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 8, 19),
(33, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111100001111111111111111111\r\n111111110000000011111111111111111\r\n111111110000000001111111111111111\r\n111111110000000001111111111111111\r\n111111110000000000111111111111111\r\n111111110000000000111111111111111\r\n111111110000000000111111111111111\r\n111111110000000000111111111111111\r\n111111111000000000111111111111111\r\n111111111100000001111111111111111\r\n111111111111000011111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 9, 21),
(34, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111100000111111111111111111\r\n111111111000000011111111111111111\r\n111111110000000001111111111111111\r\n111111110000000001111111111111111\r\n111111110000000001111111111111111\r\n111111111000000001111111111111111\r\n111111111000000001111111111111111\r\n111111111110000011111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 8, 18),
(35, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111100000011111111111111111111\r\n111111100000001111111111111111111\r\n111111100000000111111111111111111\r\n111111100000000111111111111111111\r\n111111110000000111111111111111111\r\n111111111000000111111111111111111\r\n111111111100001111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 7, 19),
(36, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111100111111111111111111111\r\n111111111000001111111111111111111\r\n111111110000011111111111111111111\r\n111111100000011111111111111111111\r\n111111100000001111111111111111111\r\n111111100000001111111111111111111\r\n111111110000000101111111111111111\r\n111111110000000001111111111111111\r\n111111111000000001111111111111111\r\n111111111100000011111111111111111\r\n111111111111101111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 8, 18),
(37, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111100011111111011111111111111\r\n111111100111100000001111111111111\r\n111111000000100000000111111111111\r\n111111000000000000000011111111111\r\n111111000000000000000011111111111\r\n111111000000000000000111111111111\r\n111111100000000000000111111111111\r\n111111110000000000001111111111111\r\n111111111000000000021111111111111\r\n111111111100000000221111111111111\r\n111111111110000002211111111111111\r\n111111111111000022111111111111111\r\n111111111111100222111111111111111\r\n111111111111112222211111111111111\r\n111111111111111222111111111111111\r\n111111111111111121111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 8, 15),
(38, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111110001111111111111111111111\r\n111111100000011111111111111111111\r\n111111000000011111111111111111111\r\n111111100000001111111111111111111\r\n111111100000000111111111111111111\r\n111111110000000000111111111111111\r\n111111111000000000111111111111111\r\n111111111100000000111111111111111\r\n111111111110000001111111111111111\r\n111111111111000022111111111111111\r\n111111111111100222111111111111111\r\n111111111111112221111111111111111\r\n111111111111111211111111111111111\r\n111111111111111121111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 9, 15),
(39, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111100111111111111111111\r\n111111111100000111111111111111111\r\n111111111000000111111111111111111\r\n111111111000000111111111111111111\r\n111111110000000111111111111111111\r\n111111100000000001111111111111111\r\n111111000000000000111111111111111\r\n111111000000000000011111111111111\r\n111111100000000000000111111111111\r\n111111110000000000001111111111111\r\n111111111000000000021111111111111\r\n111111111100000000222111111111111\r\n111111111110000002222111111111111\r\n111111111111000022221111111111111\r\n111111111111100222211111111111111\r\n111111111111112111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111121111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 9, 15),
(40, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111110111111111111111111111\r\n111111111110101111111111111111111\r\n111111111110000011111111111111111\r\n111111111110000000111111111111111\r\n111111111100000000011111111111111\r\n111111111100000000011111111111111\r\n111111111100000000011111111111111\r\n111111111100000000011111111111111\r\n111111111100000000011111111111111\r\n111111111000000000011111111111111\r\n111111111000000000011111111111111\r\n111111111100000000011111111111111\r\n111111111111000000011111111111111\r\n111111111111100000011111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 13, 24),
(41, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111110111111111111111111111\r\n111111111110101111111111111111111\r\n111111111110000011111111111111111\r\n111111111110000000111111111111111\r\n111111111100000000011111111111111\r\n111111111100000000011111111111111\r\n111111101100000000011111111111111\r\n111111001100000000011111111111111\r\n111111001100000000011111111111111\r\n111111101000000000011111111111111\r\n111111111000000000011111111111111\r\n111111111100000000011111111111111\r\n111111111111000000011111111111111\r\n111111111111100000011111111111111\r\n111111111111111111111111111111111\r\n111111111111101111111111111111111\r\n111111111111112111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111121111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 10, 16);
INSERT INTO `mapas_privados` (`id`, `mapa`, `posX`, `posY`) VALUES
(42, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111110001111111111111111111111\r\n111111100000011111111111111111111\r\n111111110000011111111111111111111\r\n111111110000011111111111111111111\r\n111111110000011111111111111111111\r\n111111111100111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111101111111111111111111\r\n111111111111112111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111121111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 8, 19),
(43, '111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111100001111111111111111111\r\n111111111000000111111111111111111\r\n111111110000000111111111111111111\r\n111111100000000011111111111111111\r\n111111100000000011111111111111111\r\n111111110000000011111111111111111\r\n111111110000000011111111111111111\r\n111111111000000111111111111111111\r\n111111111110001111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111101111111111111111111\r\n111111111111112111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111121111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111\r\n111111111111111111111111111111111', 8, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mapas_publicos`
--

CREATE TABLE `mapas_publicos` (
  `id` int(11) NOT NULL,
  `mapa` text NOT NULL,
  `posX` int(11) NOT NULL DEFAULT 11,
  `posY` int(11) NOT NULL DEFAULT 11
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mapas_publicos`
--

INSERT INTO `mapas_publicos` (`id`, `mapa`, `posX`, `posY`) VALUES
(1, '1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111110111111111111111111\n1111111100001111111111111111\n1111111000000001111111111111\n1111110000000000111111111111\n1111100000000000011111111111\n1111000000000000001111111111\n1110000000000000000111111111\n1110000000000000011111111111\n1111000000000000011111111111\n1111100000000000001111111111\n1111110000000000001111111111\n1111111000000000011111111111\n1111111100000000111111111111\n1111111110000001111111111111\n1111111111000011111111111111\n1111111111100111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111', 11, 11),
(2, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111110011111110111111111111\r\n1111100000011000011111111111\r\n1111000000000000001111111111\r\n1111100000000000000111111111\r\n1110000000000000000011111111\r\n1111000000000000000011111111\r\n1111100000000100000111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000111111111111\r\n1111111110000000111111111111\r\n1111111111000001111111111111\r\n1111111111100011111111111111\r\n1111111111110111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 12, 12),
(3, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111100111111111111111\r\n1111111100000011111111111111\r\n1111111000000001111111111111\r\n1111110000000000111111111111\r\n1111100000000000011111111111\r\n1111111000110000001111111111\r\n1111100000010000000111111111\r\n1111100000000000000011111111\r\n1111100000000000000011111111\r\n1111100000000010000111111111\r\n1111110000001100001111111111\r\n1111111000111000011111111111\r\n1111111100011000111111111111\r\n1111111110000000111111111111\r\n1111111111000001111111111111\r\n1111111111101111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 8),
(4, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111000000001111111111111\r\n1111110000000000111111111111\r\n1111100000000000011111111111\r\n1111110000000000001111111111\r\n1111110000000010000111111111\r\n1111110000001111100111111111\r\n1111110000001111111111111111\r\n1111110000001111111111111111\r\n1111110000001111111111111111\r\n1111111000000111111111111111\r\n1111111100000111111111111111\r\n1111111110000011111111111111\r\n1111111111000001111111111111\r\n1111111111100011111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 8, 10),
(5, '1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111001111111111111111\n1111111110000111111111111111\n1111111100000011111111111111\n1111111000000001111111111111\n1111110000000000111111111111\n1111100000000110011111111111\n1111000000000110001111111111\n1110000000000000000111111111\n1110000000000000000011111111\n1111000000000000000011111111\n1111100000000000000111111111\n1111110000000000001111111111\n1111111000000000011111111111\n1111111100000000011111111111\n1111111110000000111111111111\n1111111111000001111111111111\n1111111111100011111111111111\n1111111111110111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111', 10, 10),
(6, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111110111111111111111\r\n1111111111000011111111111111\r\n1111111111100001111111111111\r\n1111110001111100111111111111\r\n1111100000011110011111111111\r\n1111000000011110001111111111\r\n1110000000000100001111111111\r\n1111000100000000000111111111\r\n1111111111000000000111111111\r\n1111111111111000000111111111\r\n1111111111111000000111111111\r\n1111111111111100001111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 7, 10),
(7, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111001111111111111111\r\n1111111110010111111111111111\r\n1111111110011011111111111111\r\n1111111100001001111111111111\r\n1111111100000000111111111111\r\n1111111100000000011111111111\r\n1111111100000000001111111111\r\n1111111000000000001111111111\r\n1111111000000000011111111111\r\n1111110000000000011111111111\r\n1111100000000000011111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000011111111111\r\n1111111110000000111111111111\r\n1111111111000001111111111111\r\n1111111111100011111111111111\r\n1111111111110111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 8, 10),
(8, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111100011111111111111\r\n1111111000000001111111111111\r\n1111111000000000111111111111\r\n1111110000000000011111111111\r\n1111110000000000011111111111\r\n1111111000000000011111111111\r\n1111111000000000111111111111\r\n1111111100000001111111111111\r\n1111111110000001111111111111\r\n1111111111000001111111111111\r\n1111111111110001111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(9, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111110111111111111111111\r\n1111111100111111111111111111\r\n1111111000110011111111111111\r\n1111110000000001111111111111\r\n1111100000000000111111111111\r\n1111000000000000011111111111\r\n1110000000000000001111111111\r\n1110010000000000000111111111\r\n1111010000000001000111111111\r\n1111101000000000001111111111\r\n1111110000000000001111111111\r\n1111111000000000001111111111\r\n1111111100000000011111111111\r\n1111111110000000111111111111\r\n1111111111000001111111111111\r\n1111111111100011111111111111\r\n1111111111110111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(10, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111110001111111111111111\r\n1111111110000111111111111111\r\n1111111110000011111111111111\r\n1111111111000001111111111111\r\n1111111111100001111111111111\r\n1111111111110001111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 9, 12),
(11, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111011111111111111111\r\n1111111110101111111111111111\r\n1111111100010111111111111111\r\n1111111010110011111111111111\r\n1111110110010001111111111111\r\n1111101011000000111111111111\r\n1111100001000000011111111111\r\n1111000000000000101111111111\r\n1111100000000000000111111111\r\n1111110000000000000011111111\r\n1111110000000000000111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000111111111111\r\n1111111110000001111111111111\r\n1111111111001111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 8, 12),
(12, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111011111111111111111\r\n1111111110101111111111111111\r\n1111111100010111111111111111\r\n1111111010110011111111111111\r\n1111110110010001111111111111\r\n1111101011000000111111111111\r\n1111100001000000011111111111\r\n1111000000000000101111111111\r\n1111100000000000000111111111\r\n1111110000000000000011111111\r\n1111110000000000000111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000111111111111\r\n1111111110000001111111111111\r\n1111111111001111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 8, 12),
(13, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111110011111111111111111\r\n1111111100001111111111111111\r\n1111111000000011111111111111\r\n1111110000000001111111111111\r\n1111110000000001111111111111\r\n1111110000000000111111111111\r\n1111100000000000111111111111\r\n1111100000000000111111111111\r\n1111100000000000011111111111\r\n1111100000000000001111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000111111111111\r\n1111111110000001111111111111\r\n1111111111000011111111111111\r\n1111111111100111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 13, 10),
(14, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111110011111111111111111\r\n1111111100001111111111111111\r\n1111111000000111111111111111\r\n1111110000011011111111111111\r\n1111100100001001111111111111\r\n1111000110000000111111111111\r\n1111000010000000011111111111\r\n1111000000000000001111111111\r\n1111000000000000000111111111\r\n1111100000000000000111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000111111111111\r\n1111111110000001111111111111\r\n1111111111000011111111111111\r\n1111111111100111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 8),
(15, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111001111111111111111\r\n1111111110000111111111111111\r\n1111111100000011111111111111\r\n1111111000000001111111111111\r\n1111110000000000111111111111\r\n1111100000000000011111111111\r\n1111000000000000001111111111\r\n1110000000000000000111111111\r\n1110000000000000000011111111\r\n1111000000000000000011111111\r\n1111100000000000000111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000111111111111\r\n1111111110000001111111111111\r\n1111111111000011111111111111\r\n1111111111100111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(16, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111001111111111111111\r\n1111111111001111111111111111\r\n1111110011101111111111111111\r\n1111100000101111111111111111\r\n1111000000001111111111111111\r\n1110000000000111111111111111\r\n1100000000000000001111111111\r\n1110000000000000000111111111\r\n1111000000000000000011111111\r\n1111100000000000000111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000111111111111\r\n1111111110000001111111111111\r\n1111111111000011111111111111\r\n1111111111100111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(17, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111100111111111111111111\r\n1111001000111111111111111111\r\n1110001000111111011111111111\r\n1100000001111101101111111111\r\n1110000000011110000111111111\r\n1111000000001111000011111111\r\n1111100000001111000111111111\r\n1111110000000010001111111111\r\n1111111000000000011111111111\r\n1111111100000000111111111111\r\n1111111110000001111111111111\r\n1111111111000011111111111111\r\n1111111111100111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 7, 11),
(18, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111110111111111111111111\r\n1111111100111111111111111111\r\n1111111000010011111111111111\r\n1111110000010001111111111111\r\n1111100000010000111111111111\r\n1111000000000000111111111111\r\n1110000000000000011111111111\r\n1100000000000000001111111111\r\n1110000000000000001111111111\r\n1111000000000000000111111111\r\n1111100000000000000111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000111111111111\r\n1111111110000001111111111111\r\n1111111111000011111111111111\r\n1111111111100111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(19, '11111111111111111111111111111111111111111111111111111111\r\n11111111111111111111111111111111111111111111111111111111\r\n11111111111111111111111111111111111111111111111111111111\r\n11111111111111111111111111111111111111111111111111111111\r\n11111111111111111111111111111111111111111111111111111111\r\n11111111111111111111111111111111111111111111111111111111\r\n11111111111111111111111111111111111111111111111111111111\r\n11111111111111111111111111111111111111111111111111111111\r\n11111111111111111111111111111111111111111111111111111111\r\n11111111111111111111111111111111111111111111111111111111\r\n11111111111111111111111111111111111111111111111111111111\r\n11111111111111111111111111111111111111111111111111111111\r\n11111111111111111111111111111111111111111111111111111111\r\n11111111111111111111111111111111111111111111111111111111\r\n11111111111111111111111111111111111111111111111111111111\r\n11111111111111111111111111111111111111111111111111111111\r\n11111111111111111111111111111111111111111111111111111111\r\n11111111111100111111111111111111111111111111111111111111\r\n11111111111001111111111111111111111111111111111111111111\r\n11111111110000111111111111111111111111111111111111111111\r\n11111111100000111111111111111111111111111111111111111111\r\n11111111000000111111111111111111111111111111111111111111\r\n11111111000000111111111111111111111111111111111111111111\r\n11111110000000011111111111111111111111111111111111111111\r\n11111110000000001111111111111111111111111111111111111111\r\n11111110000000001111111111100000011111111111111111111111\r\n11111110000000000111111110000000001111111111111111111111\r\n11111100000000000000000000000000000111111111111111111111\r\n11111110000000000000000000000000000111111111111111111111\r\n11111111000000000000000000000000000111111111111111111111\r\n11111111100000000000000000000000000111111111111111111111\r\n11111111110000000000000000000000001111111111111111111111\r\n11111111111000000000000000000000011111111111111111111111\r\n11111111111100000000000000000000111111111111111111111111\r\n11111111111110000000000000000000011111111111111111111111\r\n11111111111111000000000000000000011111111111111111111111\r\n11111111111111100000000000000000011111111111111111111111\r\n11111111111111110000000000000000111111111111111111111111\r\n11111111111111111000000000000001111111111111111111111111\r\n11111111111111111100000000000011111111111111111111111111\r\n11111111111111111110000000000111111111111111111111111111\r\n11111111111111111111000000001111111111111111111111111111\r\n11111111111111111111100000011111111111111111111111111111\r\n11111111111111111111110000111111111111111111111111111111\r\n11111111111111111111111001111111111111111111111111111111\r\n11111111111111111111111111111111111111111111111111111111\r\n11111111111111111111111111111111111111111111111111111111\r\n11111111111111111111111111111111111111111111111111111111\r\n11111111111111111111111111111111111111111111111111111111\r\n11111111111111111111111111111111111111111111111111111111\r\n11111111111111111111111111111111111111111111111111111111\r\n11111111111111111111111111111111111111111111111111111111\r\n11111111111111111111111111111111111111111111111111111111', 10, 23),
(26, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111011111111111111\r\n1111111111110001111111111111\r\n1111111111100000111111111111\r\n1111111111000000011111111111\r\n1111111110000000001111111111\r\n1111111100110000000111111111\r\n1111111000000000000011111111\r\n1111110000000000000001111111\r\n1111100000000000000001111111\r\n1111000000000000000000011111\r\n1110000000000001000000111111\r\n1111000000000001000001111111\r\n1111010000000000000011111111\r\n1111111000000000010111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000001111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111100100001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(27, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111000111111111111\r\n1111111111110001001111111111\r\n1111111111100010000111111111\r\n1111111111000000001011111111\r\n1111111110000000001101111111\r\n1111111100000000000000111111\r\n1111111000011000000000011111\r\n1111110000110100000000001111\r\n1111100000000000000000101111\r\n1111000000000000000000111111\r\n1110000000000000001000111111\r\n1111001000000000000001111111\r\n1111000000000000000011111111\r\n1111100000000000000111111111\r\n1111110010000000101111111111\r\n1111111000000000011111111111\r\n1111111100000000011111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111000011111111111\r\n1111111111111100111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(28, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111100011111111111\r\n1111111111111110001111111111\r\n1111111111100110000111111111\r\n1111111111000000000011111111\r\n1111111110000000000001111111\r\n1111111100000000000000111111\r\n1111111000001100000000011111\r\n1111110000000100000000001111\r\n1111100000000000000000011111\r\n1111000000000000000000111111\r\n1110000000000000000001111111\r\n1111000000000000000001111111\r\n1111000000000000000011111111\r\n1111100000000000000111111111\r\n1111110000011000101111111111\r\n1111111000001100011111111111\r\n1111111100000000001111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111100100001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(29, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111011111111111111\r\n1111111111110000101111111111\r\n1111111111100000000111111111\r\n1111111111000000000011111111\r\n1111111110100000000001111111\r\n1111111100000000000000111111\r\n1111111000000000000000011111\r\n1111110000000000000000001111\r\n1111100000000000000000001111\r\n1111001111000000000000011111\r\n1110001111100000000000111111\r\n1111001111100000000101111111\r\n1111000111100000000011111111\r\n1111100000001000000111111111\r\n1111110000001100001111111111\r\n1111111000000110011111111111\r\n1111111100000000001111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111100100001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(30, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111010011111111111\r\n1111111111110000001111111111\r\n1111111111100000000111111111\r\n1111111111000000000111111111\r\n1111111110000000110001111111\r\n1111111100000000000000111111\r\n1111111000001000000001111111\r\n1111110000000000000001111111\r\n1111100001000000000001111111\r\n1111000001100000000000011111\r\n1110000000100000000000111111\r\n1111000000000000000001111111\r\n1111000000000000000011111111\r\n1111100000000000000111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000001111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(31, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111011111111111111\r\n1111111111110001111111111111\r\n1111111111100000111111111111\r\n1111111111000000011111111111\r\n1111111110000001001111111111\r\n1111111100000000000111111111\r\n1111111000000000000011111111\r\n1111110000000000000001111111\r\n1111100000000000000001111111\r\n1111000010000100000000011111\r\n1110000000000000000010111111\r\n1111100000000000100001111111\r\n1111000000000000000011111111\r\n1111101000000000000111111111\r\n1111110000100000001111111111\r\n1111111000000000011111111111\r\n1111111100000000001111111111\r\n1111111110000000000011111111\r\n1111111111101000000111111111\r\n1111111111100000001111111111\r\n1111111111111101111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(32, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111100011111111111\r\n1111111111111000001111111111\r\n1111111111110000000111111111\r\n1111111111100011110011111111\r\n1111111111000011100001111111\r\n1111111110011110110001111111\r\n1111111100001100011000111111\r\n1111111000001000001000011111\r\n1111110000011000001100001111\r\n1111100000010000000110001111\r\n1111000000110000000011011111\r\n1110000000110010000011111111\r\n1111000000011000111111111111\r\n1111000000001000010011111111\r\n1111101000111110110111111111\r\n1111110000000011110111111111\r\n1111111000000000001111111111\r\n1111111100000000001111111111\r\n1111111110000100000111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(33, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111000011111111111\r\n1111111111110000001111111111\r\n1111111111100000000111111111\r\n1111111111000001000011111111\r\n1111111110000001100001111111\r\n1111111100000000000000111111\r\n1111111001000001000000011111\r\n1111110000000000000000011111\r\n1111100000000000000000001111\r\n1111000000000000000100011111\r\n1110001000000010000000111111\r\n1111000000010000000001111111\r\n1111000000000000000011111111\r\n1111100000000000000111111111\r\n1111110000000000001111111111\r\n1111111000000010011111111111\r\n1111111100000000001111111111\r\n1111111110000000000111111111\r\n1111111111000001000111111111\r\n1111111111100000111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(34, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111010011111111111\r\n1111111111110000001111111111\r\n1111111111100000000111111111\r\n1111111111000000100011111111\r\n1111111110000000000001111111\r\n1111111100010000000000111111\r\n1111111010000000000000111111\r\n1111110000100000010000111111\r\n1111101000000000000000111111\r\n1111001100000000000000011111\r\n1110000100000000000000111111\r\n1111000000000010000001111111\r\n1111000000000000001011111111\r\n1111100000000000001111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000001111111111\r\n1111111110000000100111111111\r\n1111111111000000000111111111\r\n1111111111100000011111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(35, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111110111111111111\r\n1111111111111100001111111111\r\n1111111111100001110111111111\r\n1111111111000000000011111111\r\n1111111110000000000001111111\r\n1111111100000000000000111111\r\n1111111010000000000000011111\r\n1111110000000000000000001111\r\n1111100000000000000000011111\r\n1111000000000000000100111111\r\n1110000000000000000001111111\r\n1111000000000000000011111111\r\n1111000000000000000011111111\r\n1111100000000000100111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100001000001111111111\r\n1111111110000000000111111111\r\n1111111111000000010111111111\r\n1111111111100000001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(36, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111011111111111111\r\n1111111111110001111111111111\r\n1111111111100000111111111111\r\n1111111111000000011111111111\r\n1111111110000000001111111111\r\n1111111100000000000111111111\r\n1111111000000000000011111111\r\n1111110000000100000001111111\r\n1111110000000000000101111111\r\n1111110000000000000000011111\r\n1111110000000000000001111111\r\n1111100100000010000001111111\r\n1111000000000000000011111111\r\n1111100000000001000111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000001111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111110011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(37, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111010011111111111\r\n1111111111110000001111111111\r\n1111111111100010000111111111\r\n1111111111000000000011111111\r\n1111111110000000000001111111\r\n1111111100000000000000111111\r\n1111111000000010000000011111\r\n1111110000000000000100011111\r\n1111100000000000000000001111\r\n1111000000000000000001111111\r\n1110010000000000000001111111\r\n1111000000000000001001111111\r\n1111000001000100000011111111\r\n1111100000000000000111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000001111111111\r\n1111111110100000000111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(38, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111010011111111111\r\n1111111111110000001111111111\r\n1111111111100000000111111111\r\n1111111111000000000011111111\r\n1111111110010100000001111111\r\n1111111100000000000000111111\r\n1111111000000000000000011111\r\n1111111000000000011000001111\r\n1111110011110000110000001111\r\n1111110001111000000000011111\r\n1111110011111000010000111111\r\n1111110000111100000001111111\r\n1111111000111000000011111111\r\n1111111000000000101111111111\r\n1111111100000000001111111111\r\n1111111100000000011111111111\r\n1111111100000001111111111111\r\n1111111110000011111111111111\r\n1111111111001111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(39, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111110111111111111111\r\n1111111111100011111111111111\r\n1111111111000011111011111111\r\n1111111110010101101001111111\r\n1111111100000000000010111111\r\n1111111100000000000000011111\r\n1111110000100000000000011111\r\n1111100000000101000010011111\r\n1111000000000000001000011111\r\n1110000100000000000000111111\r\n1111000000000000001001111111\r\n1111000000000000000011111111\r\n1111100010000011000111111111\r\n1111110000000001101111111111\r\n1111111000000000011111111111\r\n1111111100000001001111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(40, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111110111001111111111\r\n1111111111100010100111111111\r\n1111111111000001000011111111\r\n1111111110000000010001111111\r\n1111111100000000000000111111\r\n1111111000000011100010111111\r\n1111110000000101110010001111\r\n1111100000000001100000001111\r\n1111110000000010000010011111\r\n1110011000000000000000111111\r\n1111001000000011000001111111\r\n1111000000000000000011111111\r\n1111100000000000000111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000001001111111111\r\n1111111110000001100111111111\r\n1111111111000000110111111111\r\n1111111111100000001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(41, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111011111111111111\r\n1111111111110001111111111111\r\n1111111111100000111111111111\r\n1111111111000000011111111111\r\n1111111110000000001111111111\r\n1111111100000000000111111111\r\n1111111000000000000011111111\r\n1111110000000000000001111111\r\n1111100001000000000001111111\r\n1111000000000000000000011111\r\n1110000000000000000000111111\r\n1111100000000000000001111111\r\n1111000010000000000011111111\r\n1111100000000000000111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000001111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(42, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111011111111111111\r\n1111111111110011111111111111\r\n1111111111100001100111111111\r\n1111111111000000000011111111\r\n1111111110100000000001111111\r\n1111111100000010000000111111\r\n1111111000000000000000011111\r\n1111110000000000000000001111\r\n1111100000000000000000001111\r\n1111000000000000000000011111\r\n1110000000000000001000111111\r\n1111100000000000000001111111\r\n1111000010000000000011111111\r\n1111100000000000000111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000001111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(43, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111011111111111111\r\n1111111111110101001111111111\r\n1111111111100000000111111111\r\n1111111111001000000011111111\r\n1111111110000001000001111111\r\n1111111100001000000000111111\r\n1111111000000000001000011111\r\n1111111010000000000000011111\r\n1111111000000000000000011111\r\n1111110000010000000000011111\r\n1111110000000000000000111111\r\n1111100010000000011001111111\r\n1111000000000000011111111111\r\n1111101111100010011111111111\r\n1111111111111000001111111111\r\n1111111111111110011111111111\r\n1111111111111111001111111111\r\n1111111111111111000111111111\r\n1111111111111111100111111111\r\n1111111111111111101111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(44, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111100000111111111111\r\n1111111111000000001011111111\r\n1111111110000000000001111111\r\n1111111100000000000000111111\r\n1111111000101001000000011111\r\n1111110000000000000000001111\r\n1111100000000000000001001111\r\n1111000000000000000111111111\r\n1110000000000000000001111111\r\n1111000000000000000001111111\r\n1111000000000000000011111111\r\n1111100000000100001111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000001111111111\r\n1111111111000000000111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(45, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111010011111111111\r\n1111111111110010001111111111\r\n1111111111100000000111111111\r\n1111111111000000000011111111\r\n1111111110100010000001111111\r\n1111111100000000000000111111\r\n1111111000000000000000011111\r\n1111110000000000000000001111\r\n1111100000000010010000001111\r\n1111000000000000000000011111\r\n1110000000000001000000111111\r\n1111000000000000010001111111\r\n1111000000000000010011111111\r\n1111100000000000000111111111\r\n1111110010000000001111111111\r\n1111111000001001011111111111\r\n1111111100000000001111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(46, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111011111111111111\r\n1111111111110001111111111111\r\n1111111111100000111111111111\r\n1111111111000000111111111111\r\n1111111110000000111111111111\r\n1111111100000000011111111111\r\n1111111000000000011111111111\r\n1111110000000000011111111111\r\n1111100000000000001111111111\r\n1111000000000000000111111111\r\n1110000000000001000011111111\r\n1111000000000000000001111111\r\n1111011000000000000011111111\r\n1111100000000000000111111111\r\n1111110000000011001111111111\r\n1111111000000111011111111111\r\n1111111100000111111111111111\r\n1111111110000111011111111111\r\n1111111111000011001111111111\r\n1111111111100011101111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(47, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111010011111111111\r\n1111111111110000001111111111\r\n1111111111100000000111111111\r\n1111111111001000000011111111\r\n1111111111000000000001111111\r\n1111111100000000000000111111\r\n1111111000000000000000011111\r\n1111111000000000000001111111\r\n1111111110000000000001111111\r\n1111011110001100000000111111\r\n1110011100001111100000111111\r\n1110000100000111111111111111\r\n1111000000011111111111111111\r\n1111100000011111111111111111\r\n1111110000011110001111111111\r\n1111111000011110011111111111\r\n1111111100011110001111111111\r\n1111111110011111000111111111\r\n1111111111011111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(48, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111010011111111111\r\n1111111111110000001111111111\r\n1111111111100000000111111111\r\n1111111111000000000011111111\r\n1111111110000100000001111111\r\n1111111100000000000000111111\r\n1111111000000000000000011111\r\n1111110000111100000000001111\r\n1111100000111100000000001111\r\n1111000000111100000000011111\r\n1110000000011100000000111111\r\n1111000000011100000001111111\r\n1111000000000000000011111111\r\n1111100000000000000111111111\r\n1111110000010000001111111111\r\n1111111100000000011111111111\r\n1111111100000000001111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(49, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111010011111111111\r\n1111111111110000001111111111\r\n1111111111100000000111111111\r\n1111111111000000001011111111\r\n1111111110000000001101111111\r\n1111111100000000000000111111\r\n1111111001000000000000011111\r\n1111110000010000000000001111\r\n1111100000000000000000111111\r\n1111000000000000000000111111\r\n1110000000000000010000111111\r\n1111000000000000000001111111\r\n1111000000000000000011111111\r\n1111100000000000000111111111\r\n1111110010000001001111111111\r\n1111111000000000011111111111\r\n1111111100000000011111111111\r\n1111111110000000100111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(50, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111001111111111111\r\n1111111111100000111111111111\r\n1111111111000000011111111111\r\n1111111110000000000001111111\r\n1111111100000000000000111111\r\n1111111000000000000000111111\r\n1111110000000000000000001111\r\n1111100000000000000000001111\r\n1111000000000000000100011111\r\n1110000000000000000100111111\r\n1111000000000000000001111111\r\n1111000000000000000011111111\r\n1111100000000000000111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000001111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(52, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111100011111111111111\r\n1111111101000000001111111111\r\n1111111000000000000111111111\r\n1111111000000000000111111111\r\n1111100010011000000111111111\r\n1111000000111100011111111111\r\n1111000000111110001011111111\r\n1111000000111111000011111111\r\n1111100000111111100111111111\r\n1111110000111111001111111111\r\n1111111000011110011111111111\r\n1111111100000000111111111111\r\n1111111110000001111111111111\r\n1111111111000011111111111111\r\n1111111111100111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(55, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111100111111111111\r\n1111110111110001011111111111\r\n1111100000000000000111111111\r\n1111000000000000000011111111\r\n1111000000000000000011111111\r\n1111000000000000000011111111\r\n1111100000000000000111111111\r\n1111110000000110001111111111\r\n1111111000000110011111111111\r\n1111111100000000111111111111\r\n1111111110000001111111111111\r\n1111111111000011111111111111\r\n1111111111100111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(57, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111100011111111111\r\n1111111111111000001111111111\r\n1111111111110000100111111111\r\n1111111111100000000011111111\r\n1111111111000000000001111111\r\n1111111110000001000000111111\r\n1111111100000000000101011111\r\n1111111000000000000000001111\r\n1111110000000000000000000111\r\n1111100000000010000010001111\r\n1111000000001011000000011111\r\n1110000000000011000000111111\r\n1111000000000000000101111111\r\n1111000000000000000011111111\r\n1111100000000000000111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000001111111111\r\n1111111110100000000111111111\r\n1111111111100000000111111111\r\n1111111111100100001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(58, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111100011111111111\r\n1111111111111000001111111111\r\n1111111111110000000111111111\r\n1111111111100001000011111111\r\n1111111111000000000001111111\r\n1111111110000000000000111111\r\n1111111100000000000000011111\r\n1111111000000000000000001111\r\n1111110100000000000000010111\r\n1111100000000000000000001111\r\n1111000111111000000000011111\r\n1110000111111000000000111111\r\n1111000111111000000101111111\r\n1111010011111010000011111111\r\n1111100000111000000111111111\r\n1111110000110000001111111111\r\n1111111001000000011111111111\r\n1111111100000000001111111111\r\n1111111110000000010111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(59, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111100011111111111\r\n1111111111111000001111111111\r\n1111111111110000000111111111\r\n1111111111100000100011111111\r\n1111111111000000000001111111\r\n1111111110000000000000111111\r\n1111111100100000001000011111\r\n1111111000000000001100001111\r\n1111110000000000000000000111\r\n1111100000000000000000001111\r\n1111000000000000000000111111\r\n1110000000000000000000111111\r\n1111000000000000000001111111\r\n1111000000000000110011111111\r\n1111100100000000111111111111\r\n1111110001000000011111111111\r\n1111111001100000011111111111\r\n1111111100000000001111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111100100001111111111\r\n1111111111111110011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(60, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111100011111111111\r\n1111111111111000001111111111\r\n1111111111110000011111111111\r\n1111111111100000011011111111\r\n1111111111010000000001111111\r\n1111111110011000000000111111\r\n1111111100000000000000011111\r\n1111111000000000000000001111\r\n1111110000001000010000000111\r\n1111100100000000000000001111\r\n1111000000000000000001011111\r\n1111100000000000000000111111\r\n1111100010001000000001111111\r\n1111100011000000001011111111\r\n1111110000000100000111111111\r\n1111110000000000001111111111\r\n1111111000011110011111111111\r\n1111111100011110001111111111\r\n1111111110000110000111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(61, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111100011111111111\r\n1111111111111000001111111111\r\n1111111111110000000111111111\r\n1111111111100000100011111111\r\n1111111111000000000001111111\r\n1111111110000100000000111111\r\n1111111100000000000000011111\r\n1111111000000000001000001111\r\n1111110000000000001100000111\r\n1111100000000000000000001111\r\n1111000000000000000001011111\r\n1110000000000011000000111111\r\n1111000000000001000001111111\r\n1111001000100000000111111111\r\n1111101100000000000111111111\r\n1111110000001000001111111111\r\n1111111000000000011111111111\r\n1111111100000000001111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(62, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111100011111111111\r\n1111111111111000001111111111\r\n1111111111110000000111111111\r\n1111111111100000000011111111\r\n1111111111000000000001111111\r\n1111111110000000000000111111\r\n1111111100000000000000011111\r\n1111111001100000100010001111\r\n1111110000100000000011000111\r\n1111100000000000000000001111\r\n1111000100000000000000011111\r\n1110000000000000000000111111\r\n1111000000000000000111111111\r\n1111000000000000000111111111\r\n1111100000000000000111111111\r\n1111111000001000001111111111\r\n1111111100000000011111111111\r\n1111111100000000001111111111\r\n1111111110100000000111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(63, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111100011111111111\r\n1111111111111000001111111111\r\n1111111111110000000111111111\r\n1111111111100000000011111111\r\n1111111111000000000001111111\r\n1111111110000000000000111111\r\n1111111100000000001000011111\r\n1111111000000000000010001111\r\n1111110000000000000010000111\r\n1111100000100000000000001111\r\n1111000000110000000001111111\r\n1111111100000000000001111111\r\n1111111110000000000001111111\r\n1111111111010000000011111111\r\n1111111000011000000111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000001111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(64, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111100011111111111\r\n1111111111111000101111111111\r\n1111111111110000000111111111\r\n1111111111100100000011111111\r\n1111111111000000000001111111\r\n1111111110000000110000111111\r\n1111111100000000010100011111\r\n1111111000000000000000001111\r\n1111110000000000000000000111\r\n1111100000000000000000001111\r\n1111000000000010000000011111\r\n1110000000000000000000111111\r\n1111100000000000011001111111\r\n1111110100000000111011111111\r\n1111100000000000110111111111\r\n1111110000000000001111111111\r\n1111111000000000001111111111\r\n1111111100000000001111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11);
INSERT INTO `mapas_publicos` (`id`, `mapa`, `posX`, `posY`) VALUES
(65, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111011111111111111\r\n1111111111110011111111111111\r\n1111111111100011111111111111\r\n1111111111000011111111111111\r\n1111111110000011111111111111\r\n1111111100111011111100011111\r\n1111111000111111110000001111\r\n1111110000111111110000000111\r\n1111100000111111110000001111\r\n1111000000011111111000011111\r\n1110000000111111111000111111\r\n1111000000111111100001111111\r\n1111000000111111100011111111\r\n1111100111111111000111111111\r\n1111110111111111000111111111\r\n1111111111111111000111111111\r\n1111111111111111000111111111\r\n1111111111111110000111111111\r\n1111111111111110000111111111\r\n1111111111111100001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(66, '0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000', 11, 11),
(67, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111110111111111111111\r\n1111111111100111111011111111\r\n1111111111000001011001111111\r\n1111111110000000000000111111\r\n1111111100000000000010011111\r\n1111111000000000000000001111\r\n1111110000000000000000000111\r\n1111100000000000000000001111\r\n1111000000000000001000011111\r\n1110000000000000000000111111\r\n1111000000001000000001111111\r\n1111000000000010000011111111\r\n1111100000000000000111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000001111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(68, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111100011111111111\r\n1111111111111110001111111111\r\n1111111111110011100111111111\r\n1111111111100000100011111111\r\n1111111111001100110111111111\r\n1111111111100101010010111111\r\n1111111100100000000000011111\r\n1111111000000000000000001111\r\n1111110110000000000000000111\r\n1111100010000000000110001111\r\n1111000000000000010010011111\r\n1110000110000000000000111111\r\n1111000010001100000001111111\r\n1111100000010101100011111111\r\n1111111000000000100111111111\r\n1111111000000000001111111111\r\n1111111000110000011111111111\r\n1111111100010000011111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(69, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111100011111111111\r\n1111111111111000001111111111\r\n1111111111110000000111111111\r\n1111111111100000000011111111\r\n1111111111000000011111111111\r\n1111111110000001111111111111\r\n1111111100000001111111111111\r\n1111111000000011111111111111\r\n1111110000000011111111111111\r\n1111110000000011111111111111\r\n1111110000001111111111111111\r\n1111110000011111111111111111\r\n1111110000011111111111111111\r\n1111110000101111111111111111\r\n1111110000111111111111111111\r\n1111110000111111111111111111\r\n1111111000000011111111111111\r\n1111111100000011111111111111\r\n1111111110000011111111111111\r\n1111111111000011111111111111\r\n1111111111100011111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(70, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111101111111111111111\r\n1111111111001111111111111111\r\n1111111110111111111111111111\r\n1111111100111111111101111111\r\n1111111000111111111100011111\r\n1111110000111111111100000111\r\n1111100000011111111100001111\r\n1111000000011111111100011111\r\n1110000000001111111100111111\r\n1111000000001111111101111111\r\n1111000000001111111111111111\r\n1111100000000111111111111111\r\n1111110000000111111111111111\r\n1111111000000111111111111111\r\n1111111100000111111111111111\r\n1111111110000011111111111111\r\n1111111111000011111111111111\r\n1111111111100001111111111111\r\n1111111111111101111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(71, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111100011111111111\r\n1111111111111001001111111111\r\n1111111111110000000111111111\r\n1111111111100000000011111111\r\n1111111111000000000001111111\r\n1111111110100000000000111111\r\n1111111100000000000000011111\r\n1111111000000000000100001111\r\n1111110000000000000000000111\r\n1111100000000000000100011111\r\n1111000000001000000000011111\r\n1110000000000000000000111111\r\n1111000000000000110001111111\r\n1111001000000000111011111111\r\n1111100000000000011111111111\r\n1111110000000111001111111111\r\n1111111000001111111111111111\r\n1111111100001111101111111111\r\n1111111110000000001111111111\r\n1111111111000000001111111111\r\n1111111111100000001111111111\r\n1111111111111100011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(72, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111100011111111111\r\n1111111111111001001111111111\r\n1111111111110000000111111111\r\n1111111111100010000011111111\r\n1111111111000000000001111111\r\n1111111110000000000000111111\r\n1111111100000000000000011111\r\n1111111000000000000000001111\r\n1111110000000000000000000111\r\n1111100000000000000000001111\r\n1111000000000000000100011111\r\n1110003000000000000000111111\r\n1111000000001100000001111111\r\n1111000000000100000011111111\r\n1111100000000000010111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000001111111111\r\n1111111111100000000111111111\r\n1111111111111110000111111111\r\n1111111111111111101111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(73, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111100000111111011111111111\r\n1111100000111000011111111111\r\n1111100001111100011111111111\r\n1111110001111100011111111111\r\n1111111000000000011111111111\r\n1111111100000000011111111111\r\n1111111110000000011111111111\r\n1111111111000000111111111111\r\n1111111111100000111111111111\r\n1111111111111101111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(74, '0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000', 11, 11),
(78, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111101011111111111\r\n1111111111111000001111111111\r\n1111111111110000000111111111\r\n1111111111100000000011111111\r\n1111111111000000000001111111\r\n1111111110000000000000111111\r\n1111111100000000000001111111\r\n1111111000000000000001101111\r\n1111110000000000000000000111\r\n1111100000000000000000001111\r\n1111000000000000000000011111\r\n1110000000000000010000111111\r\n1111000000000000000001111111\r\n1111000000000010000011111111\r\n1111100000000000000111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000001111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111110000001111111111\r\n1111111111111000011111111111\r\n1111111111111100111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(79, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111011111111\r\n1111111111111111111011111111\r\n1111111111111111111000111111\r\n1111111111111111111000011111\r\n1111111111111111111000001111\r\n1111111111111111111000000111\r\n1111111111001111111000001111\r\n1111111100001111111000011111\r\n1111111101111111100000111111\r\n1111111101111111100001111111\r\n1111111101111111100011111111\r\n1111111101111110000111111111\r\n1111110000111110001111111111\r\n1111111000011100011111111111\r\n1111111100000100001111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111110000001111111111\r\n1111111111111000011111111111\r\n1111111111111100111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(80, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111100011111111111\r\n1111111111111000001111111111\r\n1111111111110000000111111111\r\n1111111111111000000011111111\r\n1111111111111000000001111111\r\n1111111111111000000000111111\r\n1111111111111000000000011111\r\n1111111111111010000000001111\r\n1111110011110000000000000111\r\n1111100011100000000000001111\r\n1111000010000010000000011111\r\n1110000000000000000000111111\r\n1111000000000000000001111111\r\n1111000000000000000011111111\r\n1111100000001000000111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000001111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111110000001111111111\r\n1111111111111000011111111111\r\n1111111111111100111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(81, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111100011111111111\r\n1111111111111000001111111111\r\n1111111111110000000111111111\r\n1111111111100000000011111111\r\n1111111111010100000001111111\r\n1111111110000000000100111111\r\n1111111100010000000000011111\r\n1111111000000000000000001111\r\n1111110000100000000000000111\r\n1111100000000000000000001111\r\n1111000000010000000000111111\r\n1111000001000000000001111111\r\n1111110010101000000011111111\r\n1111111110000000000011111111\r\n1111110000000000000111111111\r\n1111111000000000001111111111\r\n1111111111000000011111111111\r\n1111111100000000001111111111\r\n1111111110000000000111111111\r\n1111111111001000000111111111\r\n1111111111110000001111111111\r\n1111111111111000011111111111\r\n1111111111111100111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(82, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111101011111111111\r\n1111111111111000011111111111\r\n1111111111110001000111111111\r\n1111111111100000000011111111\r\n1111111111000000001001111111\r\n1111111110000000000000111111\r\n1111111100000000000001011111\r\n1111111000000000000000001111\r\n1111110000000000000000000111\r\n1111100000000000000110001111\r\n1111000000001000000000011111\r\n1110000000000000000100111111\r\n1111001000000000000001111111\r\n1111000000000000001111111111\r\n1111100000000000011111111111\r\n1111110000000000111111111111\r\n1111111000000000111111111111\r\n1111111101000000111111111111\r\n1111111110000000111111111111\r\n1111111111000000111111111111\r\n1111111111110000011111111111\r\n1111111111111000011111111111\r\n1111111111111100111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(83, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111100011111111111\r\n1111111111111000001111111111\r\n1111111111110000000111111111\r\n1111111111100000000011111111\r\n1111111111000000000011111111\r\n1111111110000000000011111111\r\n1111111100000000000011111111\r\n1111111000000111000011111111\r\n1111110000001111100011111111\r\n1111100000000111111111111111\r\n1111000000000011111111111111\r\n1110000000000111111111111111\r\n1111100000000111111111111111\r\n1111000000000111111111111111\r\n1111100000100111111111111111\r\n1111110000000111111111111111\r\n1111111000000111111111111111\r\n1111111100000111111111111111\r\n1111111110000111111111111111\r\n1111111111000011111111111111\r\n1111111111110001111111111111\r\n1111111111111000111111111111\r\n1111111111111100111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(84, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111100011111111111\r\n1111111111111000001111111111\r\n1111111111111100010111111111\r\n1111111111111110000011111111\r\n1111111111111110000001111111\r\n1111111111111110000000111111\r\n1111111101111110000000011111\r\n1111111000011110000000001111\r\n1111110000001110000000000111\r\n1111100100000000000000001111\r\n1111000000000000000000011111\r\n1110000000000001110000111111\r\n1111000000001111000001111111\r\n1111000000011000000011111111\r\n1111100000111000001111111111\r\n1111110001111100111111111111\r\n1111111001110010111111111111\r\n1111111101110000111111111111\r\n1111111110110000011111111111\r\n1111111111000000001111111111\r\n1111111111110000001111111111\r\n1111111111111000011111111111\r\n1111111111111100111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(85, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111110111111111\r\n1111111111111111100011111111\r\n1111111111111111000001111111\r\n1111111111111110000010111111\r\n1111111111111100000000011111\r\n1111111001111000000000011111\r\n1111110000110000000000111111\r\n1111100000000100000001111111\r\n1111000000000000000001111111\r\n1110000100000000000001111111\r\n1111000000000010000001111111\r\n1111000000000000000011111111\r\n1111100000000000000111111111\r\n1111110000000000001111111111\r\n1111111000000000111111111111\r\n1111111100000000001111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111110000001111111111\r\n1111111111111000011111111111\r\n1111111111111100111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(86, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111011111111\r\n1111111111111111111001111111\r\n1111111111101111110010111111\r\n1111111111111111100000011111\r\n1111111111111111100100101111\r\n1111111111111111100100000111\r\n1111101111111111100000001111\r\n1111000111101110000001011111\r\n1110000111001100000000111111\r\n1111001000001100000001111111\r\n1111000000000000000011111111\r\n1111100000000010000111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000001111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111110000001111111111\r\n1111111111111000011111111111\r\n1111111111111100111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(87, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111011111111111\r\n1111111111111111001111111111\r\n1111111111111111000111111111\r\n1111111111111111000011111111\r\n1111111111111111100001111111\r\n1111111111111111110001111111\r\n1111111111111111110000111111\r\n1111111011111111110000111111\r\n1111110001111111110101100111\r\n1111100001111111100111001111\r\n1111000000111111000110011111\r\n1110000000111110000000111111\r\n1111000000011100001001111111\r\n1111000110000000010011111111\r\n1111100111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111000011111111111\r\n1111111111111000001111111111\r\n1111111111111100000111111111\r\n1111111111111100000111111111\r\n1111111111111100001111111111\r\n1111111111111100011111111111\r\n1111111111111100111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(88, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111100011111111111\r\n1111111111111000001111111111\r\n1111111111110101100111111111\r\n1111111111100000111111111111\r\n1111111111110001111111111111\r\n1111111111111111111111111111\r\n1111111111101111110000111111\r\n1111111111111111100000001111\r\n1111110111111111100100001111\r\n1111100111111111100010111111\r\n1111000111111111100000111111\r\n1110000111111111100010111111\r\n1111000111111111110001111111\r\n1111000111111111111011111111\r\n1111100011111111111111111111\r\n1111110001111111111111111111\r\n1111111000001000111111111111\r\n1111111100001001111111111111\r\n1111111110000000011111111111\r\n1111111111000000000111111111\r\n1111111111110000001111111111\r\n1111111111111000011111111111\r\n1111111111111100111111111111\r\n1111111111111111111111111111', 11, 11),
(89, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111000001111111111111\r\n1111111110000001111111111111\r\n1111111101010001111111111111\r\n1111111000000000001111001111\r\n1111110000000000000000000111\r\n1111100000000000000000001111\r\n1111000000000000000000011111\r\n1110000000000000000000111111\r\n1111000000000000000011111111\r\n1111000000000000000011111111\r\n1111100000000000000111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000001111111111\r\n1111111110000000000111111111\r\n1111111111000000010111111111\r\n1111111111110000001111111111\r\n1111111111111000011111111111\r\n1111111111111100111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(90, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111101011111111111\r\n1111111111111000001111111111\r\n1111111111110000000111111111\r\n1111111111100000000011111111\r\n1111111111000000000001111111\r\n1111111110000000000000111111\r\n1111111100000000000000011111\r\n1111111000000000000000001111\r\n1111110000000000100000000111\r\n1111101000000000000000001111\r\n1111000000000000010000011111\r\n1110000000100011001000111111\r\n1111000000000011100001111111\r\n1111000001001000100011111111\r\n1111100000000000000111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000111111111111\r\n1111111110100001111111111111\r\n1111111111000011111111111111\r\n1111111111110111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(91, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111100111111111111\r\n1111111111111000001111111111\r\n1111111111110000000111111111\r\n1111111111100000000011111111\r\n1111111111000000000001111111\r\n1111111110000000000110111111\r\n1111111100111001000110011111\r\n1111111000111100000110001111\r\n1111110000111110111111111111\r\n1111100000111111111111111111\r\n1111000000011111111111111111\r\n1110000000001111111111111111\r\n1111000000000011111111111111\r\n1111000000000000011111111111\r\n1111100000000010111111111111\r\n1111110000000000111111111111\r\n1111111000000000111111111111\r\n1111111100000000111111111111\r\n1111111110000001111111111111\r\n1111111111000001111111111111\r\n1111111111110001111111111111\r\n1111111111111001111111111111\r\n1111111111111101111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(92, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111100011111111111\r\n1111111111111000001111111111\r\n1111111111110000000111111111\r\n1111111111100000000011111111\r\n1111111111001000000001111111\r\n1111111110000000000000111111\r\n1111111111000000000100011111\r\n1111111111010000000000001111\r\n1111110000000000000000000111\r\n1111100000000000000000001111\r\n1111000000000000000000011111\r\n1110000000000000000000111111\r\n1111000000000010000001111111\r\n1111000000000000000011111111\r\n1111100000000000000111111111\r\n1111110000000000001111111111\r\n1111111000000000011111111111\r\n1111111100000000001111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111110001001111111111\r\n1111111111111000011111111111\r\n1111111111111100111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(93, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111100011111111111\r\n1111111111111000001111111111\r\n1111111111110000000111111111\r\n1111111111100000000011111111\r\n1111111111000100000001111111\r\n1111111110000000000000111111\r\n1111111100000000000000011111\r\n1111111000000000000000001111\r\n1111110000000010000000000111\r\n1111100000000000001100001111\r\n1111000000000000000010011111\r\n1110000000000000000010111111\r\n1111000000000000000001111111\r\n1111000000000000000011111111\r\n1111100000000000000111111111\r\n1111110000000000001111111111\r\n1111111000000010011111111111\r\n1111111100000000001111111111\r\n1111111110000000000111111111\r\n1111111111000000100111111111\r\n1111111111110000001111111111\r\n1111111111111000011111111111\r\n1111111111111100111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(95, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111001111111111111\r\n1111111111111001111111111111\r\n1111111111111101111111111111\r\n1111111100111000111111111111\r\n1111111000000000111111111111\r\n1111110000000000111111111111\r\n1111100000000000011111111111\r\n1111100000000000001111111111\r\n1111000000000000001111111111\r\n1111000000000000001111111111\r\n1111100000000000001111111111\r\n1111110000000000001111111111\r\n1111111000000000001111111111\r\n1111111100000000011111111111\r\n1111111110000000111111111111\r\n1111111111000001111111111111\r\n1111111111110011111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(96, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1110001111111111111111111111\r\n1110001111111111111111111111\r\n1111001100111111111111111111\r\n1111100000000000111111111111\r\n1111110000000000111111111111\r\n1111111000000000111111111111\r\n1111111100000000011111111111\r\n1111111110000000011111111111\r\n1111111111000000011111111111\r\n1111111111100000011111111111\r\n1111111111111000111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(102, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111011111111111111111\r\n1111111110011111111111111111\r\n1111111100001111111111111111\r\n1111111100000111001111111111\r\n1111111110000000011111111111\r\n1111111111000000011011111111\r\n1111111111100000000001111111\r\n1111111111100000000001111111\r\n1111111111110000000011111111\r\n1111111111111000000011111111\r\n1111111111111100000111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(103, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111100111111111111111111\r\n1111111100011111111111111111\r\n1111111000001101111111111111\r\n1111111000000000011111111111\r\n1111111000000000001111111111\r\n1111110000000000001111111111\r\n1111110000000000001111111111\r\n1111111011000000011111111111\r\n1111111111000000111111111111\r\n1111111110000001111111111111\r\n1111111111000011111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 9, 13),
(104, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111100111111111111111111\r\n1111111100011111111111111111\r\n1111111000001101111111111111\r\n1111111000000000011111111111\r\n1111111000000000001111111111\r\n1111110000000000001111111111\r\n1111110000000000001111111111\r\n1111111011000000011111111111\r\n1111111111000000111111111111\r\n1111111110000001111111111111\r\n1111111111000011111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 10, 12),
(105, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111110001000011111111111111\r\n1111100000000111111111111111\r\n1111100000001111111111111111\r\n1111100000001111111111111111\r\n1111110000000001111111111111\r\n1111111010000000111111111111\r\n1111111111000110111111111111\r\n1111111110000100111111111111\r\n1111111111000000111111111111\r\n1111111111111001111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 7, 14),
(108, '1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111001111111111111\n1111111111110000111111111111\n1111111111100000011111111111\n1111111111000000001001111111\n1111111110000000000000111111\n1111111100000000000000111111\n1111111000000000000000111111\n1111110000000000000000011111\n1111100000000000000000011111\n1111000000000100000000011111\n1110000000000100000000111111\n1110000000000110000001111111\n1111000000000011000011111111\n1111100000000000000011111111\n1111110000000000000011111111\n1111111000000000000011111111\n1111111100000000000011111111\n1111111110000000000111111111\n1111111111000000001111111111\n1111111111111100011111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111\n1111111111111111111111111111', 9, 9),
(114, '0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000\r\n0000000000000000000000000000', 11, 11),
(214, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111000000111111111111\r\n1111111110000000011111111111\r\n1111111110000000111111111111\r\n1111111110000001111111111111\r\n1111011110000011111011111111\r\n1110011110000011110001111111\r\n1111111111000001100001111111\r\n1111111111100000000011111111\r\n1111111111111000000011111111\r\n1111111111111100000011111111\r\n1111111111111110000011111111\r\n1111111101111111101111111111\r\n1111111111111111111111111111\r\n1111111111111011111111111111\r\n1111111111110111111111111111\r\n1111111111111011111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(215, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111100111111111111111111\r\n1111111000001111111111111111\r\n1111110000010011111111111111\r\n1111100000000011111111111111\r\n1111000000000011111111111111\r\n1111000000000000111111111111\r\n1111000000000000111111111111\r\n1111100000000000100111111111\r\n1111110000000000001111111111\r\n1111111000000000000111111111\r\n1111111100000000000111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111100001111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(216, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111011111111111111\r\n1111111111111010011111111111\r\n1111111111111000001111111111\r\n1111111111110000001111111111\r\n1111100000000000000111111111\r\n1111000000000000000111111111\r\n1111000000000000000111111111\r\n1111100000000000000111111111\r\n1111110000000000000111111111\r\n1111111000000000000111111111\r\n1111111100000000000111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111100001111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(217, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111001101111111\r\n1111111111111111000000011111\r\n1111111111111111000000011111\r\n1111111111111111000000001111\r\n1111111111111110000000000111\r\n1111111111111110000000001111\r\n1111111111110000000000011111\r\n1111110000000000000000111111\r\n1111100000000000000001111111\r\n1111100000000000000001111111\r\n1111100000000000000011111111\r\n1111110000000000000111111111\r\n1111111000000000000111111111\r\n1111111100000000000111111111\r\n1111111110000000000111111111\r\n1111111111000000100111111111\r\n1111111111100000111111111111\r\n1111111111111100111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(218, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111101111111\r\n1111111111111111110000011111\r\n1111111111111111000000011111\r\n1111111111111111000000001111\r\n1111111111111110000000000111\r\n1111111111111110000000001111\r\n1111111111110000000000011111\r\n1111111100000000000000111111\r\n1111111110000000000001111111\r\n1111111100000000000001111111\r\n1111100000000000000011111111\r\n1111110000000000000111111111\r\n1111111000000000000111111111\r\n1111111100000000000111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111100000011111111111\r\n1111111111111100111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(219, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111110111111111\r\n1111111111111111110011111111\r\n1111111111100000000001111111\r\n1111111111000000000000111111\r\n1111111111000000000000001111\r\n1111111111000000000000001111\r\n1111111111100000000000000111\r\n1111111111100000000000001111\r\n1111111111000000000000011111\r\n1111111000000000000000111111\r\n1111110000000000000001111111\r\n1111110000000000000011111111\r\n1111110110000000000111111111\r\n1111111110000000000111111111\r\n1111111110000000000111111111\r\n1111111110000000000011111111\r\n1111111111000000000011111111\r\n1111111111111100000111111111\r\n1111111111110110001111111111\r\n1111111111111011111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(220, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111100000011111111\r\n1111111111110000000000111111\r\n1111111111100000000000011111\r\n1111111110000000000000011111\r\n1111111100000000000000001111\r\n1111111100000000000000001111\r\n1111111100000000000000000111\r\n1111111100000000111100001111\r\n1111111000000000111110011111\r\n1111110000000000011111111111\r\n1111100000000000011011111111\r\n1111100000000000111111111111\r\n1111100000000001111111111111\r\n1111110000000001111111111111\r\n1111111100000011111111111111\r\n1111111100000001111111111111\r\n1111111110000000111111111111\r\n1111111111011100011111111111\r\n1111111111110110011111111111\r\n1111111111111000011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(222, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111100011111111\r\n1111111111111111000000111111\r\n1111111111111110000000011111\r\n1111111111111100000000011111\r\n1111111111110000000000011111\r\n1111111100100000000000111111\r\n1111111100000000000000111111\r\n1111110000000000000000111111\r\n1111110000000000000001111111\r\n1111110000000000000001111111\r\n1111100000000000000001111111\r\n1111100000000000000011111111\r\n1111100000100000000111111111\r\n1111110000100000001111111111\r\n1111111100000010001111111111\r\n1111111100000000001111111111\r\n1111111110000000001111111111\r\n1111111111011100001111111111\r\n1111111111110110011111111111\r\n1111111111111001111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(223, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111110111111111\r\n1111111111111111000011111111\r\n1111111111110000000001111111\r\n1111111111100000000000111111\r\n1111111111000000000000011111\r\n1111111110000000000000001111\r\n1111111100000000000000001111\r\n1111111000000000000000000111\r\n1111110000000000000000001111\r\n1111100000000000001000011111\r\n1111000000000000010000111111\r\n1111000000000000100001111111\r\n1111100000000000000001111111\r\n1111100000000000000011111111\r\n1111110000000000000111111111\r\n1111111000000000000111111111\r\n1111111100000000000111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111100011111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(224, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111100111111111111111111\r\n1111111000000111111111111111\r\n1111110000000111111111111111\r\n1111100000000111111111111111\r\n1111000000000111111111111111\r\n1111000000000001111111111111\r\n1111000000000000000111111111\r\n1111100000000000000111111111\r\n1111110000000000000111111111\r\n1111111000000000000111111111\r\n1111111100000000000111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111100001111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(225, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111010111111\r\n1111111111111111100000011111\r\n1111111111111111000000011111\r\n1111111111111110000000001111\r\n1111111111111100000000000111\r\n1111111111111100000000000111\r\n1111101100000000100000001111\r\n1111000000000011110000011111\r\n1111000000000011110000111111\r\n1111100000000001100001111111\r\n1111100000000000000011111111\r\n1111100000000000000111111111\r\n1111110000000000000111111111\r\n1111111100000000000111111111\r\n1111111100000000000011111111\r\n1111111110000000000011111111\r\n1111111111011111100111111111\r\n1111111111110111111111111111\r\n1111111111111011111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(226, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111101111111111\r\n1111111111111111000011111111\r\n1111111111111110000010111111\r\n1111111111111100000000111111\r\n1111111111111100000000011111\r\n1111111111110000000000011111\r\n1111111111100000000000001111\r\n1111111111000000000000000011\r\n1111111110000000000000000111\r\n1111101000000000000000011111\r\n1111000000000000000000111111\r\n1111000000000000000001111111\r\n1111000000000000000001111111\r\n1111100000000000000011111111\r\n1111100000000000000111111111\r\n1111110000000000000111111111\r\n1111111100000000000111111111\r\n1111111100000000000011111111\r\n1111111110000000000011111111\r\n1111111111000000000111111111\r\n1111111111110000001111111111\r\n1111111111111000011111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(227, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111100011111111\r\n1111111111111111100011111111\r\n1111111111111111000001111111\r\n1111111111111100000000111111\r\n1111111111000000000000011111\r\n1111111110000000000000001111\r\n1111111100000000000000001111\r\n1111111000000000000000000111\r\n1111110000000000000000001111\r\n1111100000000000000000011111\r\n1111100000000000000000111111\r\n1111100000000000000001111111\r\n1111100000000000000011111111\r\n1111100000000000000111111111\r\n1111110000000000000111111111\r\n1111111000000000000111111111\r\n1111111100000000000111111111\r\n1111111110000000000111111111\r\n1111111111000000000111111111\r\n1111111111100000001111111111\r\n1111111111111100001111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(228, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111110111111111111111111\r\n1111111100000100011111111111\r\n1111111000000000001111111111\r\n1111110000000000000111111111\r\n1111100000000000000011111111\r\n1111100000000000000011111111\r\n1111100000000000000011111111\r\n1111100000000000010011111111\r\n1111100000000000011111111111\r\n1111110000000000011111111111\r\n1111111000000010111111111111\r\n1111111100000011111111111111\r\n1111111110000001111111111111\r\n1111111111000000111111111111\r\n1111111111100000111111111111\r\n1111111111111101111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(229, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111110000011111111\r\n1111111111111000000000111111\r\n1111111111110000000000111111\r\n1111111111100000000000111111\r\n1111111110000000000000011111\r\n1111111100000000000000111111\r\n1111111000000000000000111111\r\n1111110000000000000001111111\r\n1111100000000000000001111111\r\n1111100000000000000001111111\r\n1111100000000000001111111111\r\n1111100000000000011111111111\r\n1111100000000000011111111111\r\n1111110000000000011111111111\r\n1111111000000000011111111111\r\n1111111100000000011111111111\r\n1111111110000000011111111111\r\n1111111111000000011111111111\r\n1111111111100000111111111111\r\n1111111111111101111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(230, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111110000011111111\r\n1111111111111100000000111111\r\n1111111111111000000000111111\r\n1111111111110000000000011111\r\n1111111111000000000000001111\r\n1111111110000000000000011111\r\n1111111100000000000000011111\r\n1111111000000000000000011111\r\n1111110000000000000000011111\r\n1111100000000000000110111111\r\n1111100000000000001101111111\r\n1111100000000000011011111111\r\n1111100000000000011011111111\r\n1111110000000000010111111111\r\n1111111000000000000111111111\r\n1111111100000000000111111111\r\n1111111110000000000111111111\r\n1111111111000111111111111111\r\n1111111111100111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(231, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111110011111111111\r\n1111111111111110000011111111\r\n1111111111111100000000111111\r\n1111111111101100000000111111\r\n1111111111000000000000011111\r\n1111111110000000000000001111\r\n1111111100000000000000011111\r\n1111111100000000000000011111\r\n1111111000000000000001111111\r\n1111110000000000000011111111\r\n1111100000000000000111111111\r\n1111100000000000001111111111\r\n1111100000000000011111111111\r\n1111100000000000011111111111\r\n1111110000000000111111111111\r\n1111111000000001111111111111\r\n1111111100000001111111111111\r\n1111111110000001111111111111\r\n1111111111000011111111111111\r\n1111111111100011111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(232, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111110011111111\r\n1111111111111111100011111111\r\n1111111111111111100111111111\r\n1111111111111111111111111111\r\n1111111111101111111111111111\r\n1111111111000111111111111111\r\n1111111111000011111111111111\r\n1111111111000001111111111111\r\n1111111110000000111111111111\r\n1111111110000000011111111111\r\n1111111000000000001111111111\r\n1111110000000000001111111111\r\n1111111000000000000111111111\r\n1111111100000000000111111111\r\n1111111110000000000111111111\r\n1111111111000000001111111111\r\n1111111111100000011111111111\r\n1111111111111110111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(233, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111101111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111011111111111111\r\n1111111100000000111111111111\r\n1111111100000000011111111111\r\n1111101000000000001111111111\r\n1111000000000000000111111111\r\n1111000000000000000111111111\r\n1111000000000000000111111111\r\n1111100000000000000011111111\r\n1111100000000000000111111111\r\n1111110000000000000111111111\r\n1111111100000000000111111111\r\n1111111100000000000011111111\r\n1111111110000000000011111111\r\n1111111111000000000111111111\r\n1111111111110000001111111111\r\n1111111111111000011111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(234, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111110010111111111111111\r\n1111111100000010011111111111\r\n1111111000000000001111111111\r\n1111110000000000000011111111\r\n1111100000000010000011111111\r\n1111000000000110000111111111\r\n1111000000011110000111111111\r\n1111000000111110000111111111\r\n1111100000111110000011111111\r\n1111100000111110000111111111\r\n1111110000011100000111111111\r\n1111111100000000000011111111\r\n1111111100000000000011111111\r\n1111111110000000000011111111\r\n1111111111000000000111111111\r\n1111111111110000001111111111\r\n1111111111111000011111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(235, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111110011111111111111111\r\n1111111100001111111111111111\r\n1111101000000001111111111111\r\n1111000000000000011111111111\r\n1111000000000000111111111111\r\n1111000000000001111111111111\r\n1111100000000011111111111111\r\n1111100000000111111111111111\r\n1111110000000111111111111111\r\n1111111100000111111111111111\r\n1111111100000000111111111111\r\n1111111110000000111111111111\r\n1111111111000000111111111111\r\n1111111111110000111111111111\r\n1111111111111000011111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(236, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111110011111111111111\r\n1111111111100000111001111111\r\n1111111111000000000000011111\r\n1111111110000000000000001111\r\n1111111100000000000000001111\r\n1111111000000000000000000011\r\n1111110000000000000000000111\r\n1111100000000000000000001111\r\n1111000000000000000000011111\r\n1111000000000000000000111111\r\n1111000000000000000001111111\r\n1111100000000000000011111111\r\n1111100000000000000111111111\r\n1111110000000000000111111111\r\n1111111100000000000111111111\r\n1111111100000000000011111111\r\n1111111110000000000011111111\r\n1111111111000000000111111111\r\n1111111111110000001111111111\r\n1111111111111000011111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11),
(237, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111101111111111\r\n1111111111111111111111111111\r\n1111111111111111111110011111\r\n1111111110000000111100001111\r\n1111111100000000001100001111\r\n1111111000000000000000000011\r\n1111110000000000000000000111\r\n1111100000000000000000001111\r\n1111000000000000000000011111\r\n1111000000000000000000111111\r\n1111000000000000000001111111\r\n1111100000000000000011111111\r\n1111100000000000000111111111\r\n1111110000000000000111111111\r\n1111111100000000000111111111\r\n1111111100000000000011111111\r\n1111111110000000000011111111\r\n1111111111000000000111111111\r\n1111111111110000001111111111\r\n1111111111111000011111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11);
INSERT INTO `mapas_publicos` (`id`, `mapa`, `posX`, `posY`) VALUES
(238, '1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111101111111111\r\n1111111111111111110001111111\r\n1111111111111111100000111111\r\n1111111111111111000000111111\r\n1111111111110000000000001111\r\n1111111111100000000000000111\r\n1111111111000000000000001111\r\n1111100000000000000000001111\r\n1111000000000000000000011111\r\n1111000000000000000000111111\r\n1111000000000011000001111111\r\n1111100000000011000011111111\r\n1111100000000000000111111111\r\n1111110000000000000111111111\r\n1111111100000000000111111111\r\n1111111100000000000011111111\r\n1111111110000000000011111111\r\n1111111111000000000111111111\r\n1111111111110000001111111111\r\n1111111111111000011111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111\r\n1111111111111111111111111111', 11, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(15000) NOT NULL,
  `contenido` varchar(15000) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `tipo_plantilla` int(11) NOT NULL DEFAULT 3 COMMENT '1 = Texto e Imagen; 2 = Imagen; 3 = Texto; 4 = 4 Imágenes',
  `url_1` varchar(1500) NOT NULL,
  `url_2` varchar(1500) NOT NULL,
  `url_3` varchar(1500) NOT NULL,
  `url_4` varchar(1500) NOT NULL,
  `fecha` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `contenido`, `image`, `tipo_plantilla`, `url_1`, `url_2`, `url_3`, `url_4`, `fecha`, `created_at`, `updated_at`) VALUES
(0, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 26/02/2021 16:25:04\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo.\rEl ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2021-7-5', NULL, NULL),
(43, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 25/08/2019 10:06:37\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2019-8-18', NULL, NULL),
(44, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos. Atrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 24/08/2019 20:02:01\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2019-8-21', NULL, NULL),
(45, '¡Resultados Upper!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. Kill\r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2019-8-22', NULL, NULL),
(46, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco. Los ganadores del evento fueron\r\r1. JosemariadjYT\r2. Viciado\r3. J\r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2019-8-24', NULL, NULL),
(47, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 01/09/2019 10:06:36\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2019-8-25', NULL, NULL),
(48, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 01/09/2019 19:33:16\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.\r\rGanador de la loteria: Betis , créditos ganados: 57000', NULL, 3, '', '', '', '', '2019-8-25', NULL, NULL),
(49, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos. Atrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 31/08/2019 20:02:02\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2019-8-28', NULL, NULL),
(50, '¡Resultados Upper!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. Robe\r2. J0SE\r3. Isecreto\r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2019-8-29', NULL, NULL),
(51, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos. Atrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 9/24/2019 4:59:46 PM\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2019-9-21', NULL, NULL),
(52, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. Bad\r2. Robe\r3. ir0nia\r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2019-9-21', NULL, NULL),
(53, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 9/1/2019 7:33:15 PM\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.\r\rGanador de la loteria: Techmo , créditos ganados: 15000', NULL, 3, '', '', '', '', '2019-9-21', NULL, NULL),
(54, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco. Los ganadores del evento fueron\r\r1. Techmo\r2. Bad\r3. Robe\r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2019-9-24', NULL, NULL),
(55, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-9-27', NULL, NULL),
(56, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos. Atrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 10/1/2019 4:59:47 PM\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2019-9-28', NULL, NULL),
(57, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. Bad\r3. Habib\r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2019-9-28', NULL, NULL),
(58, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 9/28/2019 4:59:46 PM\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2019-9-28', NULL, NULL),
(59, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco. Los ganadores del evento fueron\r\r1. Chill\r2. badbuny\r3. Habib\r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2019-10-1', NULL, NULL),
(60, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-10-4', NULL, NULL),
(61, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-10-4', NULL, NULL),
(62, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos. Atrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 10/8/2019 4:59:47 PM\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2019-10-5', NULL, NULL),
(63, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. J0SE\r3. Habib\r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2019-10-5', NULL, NULL),
(64, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 10/5/2019 4:59:48 PM\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2019-10-5', NULL, NULL),
(65, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco. Los ganadores del evento fueron\r\r1. Habib\r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2019-10-8', NULL, NULL),
(66, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-10-11', NULL, NULL),
(67, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos. Atrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 10/15/2019 4:59:46 PM\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2019-10-12', NULL, NULL),
(68, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. Chill\r2. Jakesito\r3. Goku\r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2019-10-12', NULL, NULL),
(69, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2019-10-15', NULL, NULL),
(70, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-10-18', NULL, NULL),
(71, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos. Atrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 10/22/2019 4:59:47 PM\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2019-10-19', NULL, NULL),
(72, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. Shoxie\r3. RiCHiii\r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2019-10-19', NULL, NULL),
(73, '¡Ha llegado Halloween!', '¿No has oído aún nuestra historia de terror?\r\rCuenta una leyenda de hace muchos años, que en una fecha en concreto, aparecen calabazas terrorificas, con un aspecto inquietante.\r\r¿Te atreves  atraparlas?\r\rSé el primero en obtener todas las calabazas, ¡pero cuidado! la maldición estará contigo a lo largo del día.\rMuchas cosas pueden ocurrirte, pero es el precio de tenerlas todas y llegar lejos.\rEn Boombang te deseamos suerte enfrentando a los espiritus que se pasean por las Áreas.\r\rCada calabaza suma 1 punto\rEvento acaba: 11/3/2019 12:00:00 AM\rEscribe en chat /concurso para ver el Ranking\r\rDisponibles nuevos objetos en catalogo Set New', NULL, 3, '', '', '', '', '2019-10-20', NULL, NULL),
(81, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2019-10-22', NULL, NULL),
(82, '¡Ha llegado Halloween!', '¿No has oído aún nuestra historia de terror?\r\rCuenta una leyenda de hace muchos años, que en una fecha en concreto, aparecen calabazas terrorificas, con un aspecto inquietante.\r\r¿Te atreves  atraparlas?\r\rSé el primero en obtener todas las calabazas, ¡pero cuidado! la maldición estará contigo a lo largo del día.\rMuchas cosas pueden ocurrirte, pero es el precio de tenerlas todas y llegar lejos.\rEn Boombang te deseamos suerte enfrentando a los espiritus que se pasean por las Áreas.\r\rCada calabaza suma 1 punto\rEvento acaba: 11/3/2019 12:00:00 AM\rEscribe en chat /concurso para ver el Ranking\r\rDisponibles nuevos objetos en catalogo Set New', NULL, 3, '', '', '', '', '2019-10-23', NULL, NULL),
(83, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-10-25', NULL, NULL),
(84, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja. Atrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 10/29/2019 4:59:46 PM\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2019-10-26', NULL, NULL),
(85, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. Ferrari\r2. DaniielQuiiroz\r3. Jeff\r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2019-10-26', NULL, NULL),
(86, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2019-10-29', NULL, NULL),
(87, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-11-1', NULL, NULL),
(88, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos. Atrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 11/5/2019 4:59:46 PM\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2019-11-2', NULL, NULL),
(89, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. \r3. Ferrari\r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2019-11-2', NULL, NULL),
(90, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco. Los ganadores del evento fueron\r\r1. Bad\r2. LyL,\r3. Goku\r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2019-11-5', NULL, NULL),
(91, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-11-8', NULL, NULL),
(92, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-11-8', NULL, NULL),
(93, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos. Atrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 11/12/2019 4:59:46 PM\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2019-11-9', NULL, NULL),
(94, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. Jc\r2. Bampinees\r3. Bad\r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2019-11-9', NULL, NULL),
(95, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco. Los ganadores del evento fueron\r\r1. Yunior...\r2. Candy\r3. LilTjay\r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2019-11-12', NULL, NULL),
(96, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-11-15', NULL, NULL),
(97, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos. Atrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 11/19/2019 4:59:46 PM\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2019-11-16', NULL, NULL),
(98, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. JK03\r2. Yunior...\r3. Kaze\r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2019-11-16', NULL, NULL),
(99, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco. Los ganadores del evento fueron\r\r1. JK03\r2. Candy\r3. Gabriel\r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2019-11-19', NULL, NULL),
(100, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2019-12-6', NULL, NULL),
(101, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-6', NULL, NULL),
(102, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2019-12-6', NULL, NULL),
(103, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2019-12-6', NULL, NULL),
(104, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-6', NULL, NULL),
(105, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-6', NULL, NULL),
(106, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-6', NULL, NULL),
(107, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-6', NULL, NULL),
(108, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. Ky\r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2019-12-6', NULL, NULL),
(109, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-6', NULL, NULL),
(110, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-6', NULL, NULL),
(111, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-6', NULL, NULL),
(112, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 08/12/2019 15:01:31\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2019-12-8', NULL, NULL),
(113, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja. Atrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 11/12/2019 21:24:19\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2019-12-8', NULL, NULL),
(114, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2019-12-12', NULL, NULL),
(115, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(116, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(117, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(118, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(119, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(120, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(121, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(122, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(123, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(124, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(125, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(126, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(127, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(128, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(129, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(130, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(131, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(132, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(133, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(134, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(135, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(136, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(137, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(138, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(139, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(140, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(141, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(142, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(143, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(144, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(145, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(146, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(147, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(148, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(149, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. Hache\r2. Boo\r3. Savage\r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(150, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(151, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(152, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-13', NULL, NULL),
(153, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 22/12/2019 10:24:23 p. m.\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2019-12-15', NULL, NULL),
(154, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja. Atrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 18/12/2019 10:24:24 p. m.\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2019-12-15', NULL, NULL),
(155, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2019-12-19', NULL, NULL),
(156, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(157, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(158, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(159, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(160, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(161, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(162, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(163, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(164, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(165, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(166, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(167, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(168, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(169, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(170, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(171, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(172, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(173, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(174, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(175, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(176, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(177, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(178, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(179, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(180, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(181, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(182, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-20', NULL, NULL),
(183, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja. Atrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 25/12/2019 11:06:33 p. m.\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2019-12-22', NULL, NULL),
(184, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 29/12/2019 11:06:33 p. m.\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2019-12-22', NULL, NULL),
(185, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2019-12-25', NULL, NULL),
(186, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-27', NULL, NULL),
(187, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-27', NULL, NULL),
(188, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2019-12-27', NULL, NULL),
(189, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2019-12-28', NULL, NULL),
(190, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja. Atrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 03/01/2020 0:10:08\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2019-12-31', NULL, NULL),
(191, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 07/01/2020 0:10:08\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2019-12-31', NULL, NULL),
(192, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-1-4', NULL, NULL),
(193, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. Patata\r2. Gen\r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-1-5', NULL, NULL),
(194, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja. Atrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 08/01/2020 13:15:08\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-1-5', NULL, NULL),
(195, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja. Atrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 08/01/2020 13:23:31\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-1-5', NULL, NULL),
(196, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja. Atrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 08/01/2020 13:25:00\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-1-5', NULL, NULL),
(197, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-1-5', NULL, NULL),
(198, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja. Atrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 08/01/2020 13:27:51\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-1-5', NULL, NULL),
(199, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-1-5', NULL, NULL),
(200, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos. Atrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 08/01/2020 13:28:21\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-1-5', NULL, NULL),
(201, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-1-5', NULL, NULL),
(202, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja. Atrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 08/01/2020 13:28:52\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-1-5', NULL, NULL),
(203, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos. Atrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 08/01/2020 13:29:30\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-1-5', NULL, NULL),
(204, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 07/01/2020 0:10:08\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2020-1-7', NULL, NULL),
(205, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-1-10', NULL, NULL);
INSERT INTO `noticias` (`id`, `titulo`, `contenido`, `image`, `tipo_plantilla`, `url_1`, `url_2`, `url_3`, `url_4`, `fecha`, `created_at`, `updated_at`) VALUES
(206, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2020-1-10', NULL, NULL),
(207, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2020-1-10', NULL, NULL),
(208, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2020-1-10', NULL, NULL),
(209, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2020-1-10', NULL, NULL),
(210, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja. Atrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 15/01/2020 22:34:24\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-1-12', NULL, NULL),
(211, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-1-12', NULL, NULL),
(212, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 14/01/2020 15:23:34\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2020-1-14', NULL, NULL),
(213, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-1-16', NULL, NULL),
(214, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos. Atrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 23/01/2020 6:10:03\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-1-20', NULL, NULL),
(215, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-1-20', NULL, NULL),
(216, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 21/01/2020 15:55:50\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2020-1-21', NULL, NULL),
(217, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja. Atrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 06/02/2020 6:41:31\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-2-3', NULL, NULL),
(218, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 28/01/2020 16:08:36\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2020-2-3', NULL, NULL),
(219, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-2-3', NULL, NULL),
(220, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-2-10', NULL, NULL),
(221, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos. Atrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 22/02/2020 7:35:06\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-2-19', NULL, NULL),
(222, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 10/02/2020 6:41:29\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2020-2-19', NULL, NULL),
(223, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-2-19', NULL, NULL),
(224, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-2-24', NULL, NULL),
(225, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja. Atrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 29/02/2020 7:36:27\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-2-26', NULL, NULL),
(226, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 26/02/2020 7:35:06\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2020-2-26', NULL, NULL),
(227, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-2-26', NULL, NULL),
(228, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-3-2', NULL, NULL),
(229, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 04/03/2020 7:36:26\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2020-3-9', NULL, NULL),
(230, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos. Atrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 12/03/2020 10:21:01\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-3-9', NULL, NULL),
(231, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-3-9', NULL, NULL),
(232, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 16/03/2020 10:20:59\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2020-3-17', NULL, NULL),
(233, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja. Atrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 20/03/2020 13:08:02\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-3-17', NULL, NULL),
(234, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-3-17', NULL, NULL),
(235, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-3-20', NULL, NULL),
(236, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos. Atrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 28/03/2020 22:37:57\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-3-25', NULL, NULL),
(237, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 24/03/2020 13:06:14\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2020-3-25', NULL, NULL),
(238, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-3-25', NULL, NULL),
(239, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-3-29', NULL, NULL),
(240, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja. Atrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 06/04/2020 21:47:16\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-4-3', NULL, NULL),
(241, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 01/04/2020 22:37:57\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2020-4-3', NULL, NULL),
(242, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-4-9', NULL, NULL),
(243, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 10/04/2020 21:47:15\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2020-4-11', NULL, NULL),
(244, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos. Atrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 14/04/2020 1:21:38\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-4-11', NULL, NULL),
(245, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-4-11', NULL, NULL),
(246, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-4-15', NULL, NULL),
(247, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 18/04/2020 1:21:38\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2020-4-18', NULL, NULL),
(248, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja. Atrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 21/04/2020 13:15:10\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-4-18', NULL, NULL),
(249, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-4-18', NULL, NULL),
(250, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos. Atrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 04/05/2020 14:21:24\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-5-1', NULL, NULL),
(251, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 25/04/2020 13:15:10\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2020-5-1', NULL, NULL),
(252, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-5-1', NULL, NULL),
(253, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 08/05/2020 14:21:23\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2020-6-9', NULL, NULL),
(254, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja. Atrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 12/06/2020 23:42:42\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-6-9', NULL, NULL),
(255, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-6-9', NULL, NULL),
(256, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-6-15', NULL, NULL),
(257, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 16/06/2020 23:42:41\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2020-6-17', NULL, NULL),
(258, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos. Atrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 20/06/2020 23:16:58\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-6-17', NULL, NULL),
(259, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-6-17', NULL, NULL),
(260, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2020-6-19', NULL, NULL),
(261, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-6-20', NULL, NULL),
(262, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. JuanCarlos\r2. Jorge\r3. .\r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-6-24', NULL, NULL),
(263, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 24/06/2020 23:16:58\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.\r\rGanador de la loteria: Luna , créditos ganados: 8750', NULL, 3, '', '', '', '', '2020-6-24', NULL, NULL),
(264, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja. Atrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 27/06/2020 23:16:58\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-6-24', NULL, NULL),
(265, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-6-27', NULL, NULL),
(266, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 01/07/2020 23:16:58\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.\r\rGanador de la loteria: JuanCarlos , créditos ganados: 6250', NULL, 3, '', '', '', '', '2020-7-1', NULL, NULL),
(267, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-7-1', NULL, NULL),
(268, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos. Atrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 04/07/2020 23:17:27\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-7-1', NULL, NULL),
(269, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2020-7-3', NULL, NULL),
(270, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-7-4', NULL, NULL),
(271, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 08/07/2020 23:17:26\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.\r\rGanador de la loteria: Ema , créditos ganados: 5250', NULL, 3, '', '', '', '', '2020-7-8', NULL, NULL),
(272, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-7-8', NULL, NULL),
(273, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja. Atrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 11/07/2020 23:17:49\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-7-8', NULL, NULL),
(274, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-7-11', NULL, NULL),
(275, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-7-15', NULL, NULL),
(276, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 15/07/2020 23:17:48\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.\r\rGanador de la loteria: Ema , créditos ganados: 5250', NULL, 3, '', '', '', '', '2020-7-15', NULL, NULL),
(277, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos. Atrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 18/07/2020 23:18:47\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-7-15', NULL, NULL),
(278, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2020-7-17', NULL, NULL),
(279, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-7-20', NULL, NULL),
(280, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-7-22', NULL, NULL),
(281, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 22/07/2020 23:18:46\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2020-7-22', NULL, NULL),
(282, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja. Atrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 25/07/2020 23:21:08\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-7-22', NULL, NULL),
(283, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2020-7-24', NULL, NULL),
(284, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-7-25', NULL, NULL),
(285, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-7-29', NULL, NULL),
(286, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 29/07/2020 23:21:07\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2020-7-29', NULL, NULL),
(287, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos. Atrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 01/08/2020 23:22:35\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-7-29', NULL, NULL),
(288, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco. Los ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-8-1', NULL, NULL),
(289, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 05/08/2020 23:22:34\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2020-8-5', NULL, NULL),
(290, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. Facebook\r2. Instagram\r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-8-5', NULL, NULL),
(291, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja. Atrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 08/08/2020 23:22:35\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-8-5', NULL, NULL),
(292, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2020-8-7', NULL, NULL),
(293, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens. Los ganadores del evento fueron\r\r1. Facebook\r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-8-8', NULL, NULL),
(294, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. Marcos\r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-8-12', NULL, NULL),
(295, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 12/08/2020 23:22:33\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2020-8-12', NULL, NULL),
(296, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos. Atrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 15/08/2020 23:22:34\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-8-12', NULL, NULL),
(297, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja. Atrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 14/09/2020 6:33:18\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-9-11', NULL, NULL),
(298, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 19/08/2020 23:22:32\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.\r\rGanador de la loteria: Blackpunx43 , créditos ganados: 5250', NULL, 3, '', '', '', '', '2020-9-11', NULL, NULL),
(299, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. Los ganadores de la semana fueron\r\r1. Fin\r2. boxeador.1\r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-9-11', NULL, NULL),
(300, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens. Los ganadores del evento fueron\r\r1. blackpunx\r2. Princesa\r3. boxeador.1\r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-9-14', NULL, NULL),
(301, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 18/09/2020 6:33:18\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.\r\rGanador de la loteria: Cocaine , créditos ganados: 6000', NULL, 3, '', '', '', '', '2020-9-18', NULL, NULL),
(302, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos. Atrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 21/09/2020 6:33:18\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-9-18', NULL, NULL),
(303, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers. \r\nLos ganadores de la semana fueron\r\n\r\n1. \r\n2. \r\n3. \r\n\r\nUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-9-18', NULL, NULL),
(304, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco.\rLos ganadores del evento fueron\r\r1. Princesa\r2. blackpunx\r3. Devil\r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-9-21', NULL, NULL),
(305, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja.\rAtrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 29/09/2020 10:22:31\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-9-26', NULL, NULL),
(306, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 25/09/2020 6:33:17\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.\r\rGanador de la loteria: Lani , créditos ganados: 5750', NULL, 3, '', '', '', '', '2020-9-26', NULL, NULL),
(307, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers.\rLos ganadores de la semana fueron\r\r1. Sweet\r2. Diosa\r3. Hell\r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-9-26', NULL, NULL),
(308, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco.\rLos ganadores del evento fueron\r\r1. Escanor\r2. Princeso\r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-10-1', NULL, NULL),
(309, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja.\rAtrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 08/10/2020 14:18:03\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-10-5', NULL, NULL),
(310, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 05/10/2020 14:18:03\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.\r\rGanador de la loteria: luna3471 , créditos ganados: 6000', NULL, 3, '', '', '', '', '2020-10-5', NULL, NULL),
(311, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers.\rLos ganadores de la semana fueron\r\r1. M0nkY.\r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-10-5', NULL, NULL),
(312, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens.\rLos ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-10-8', NULL, NULL),
(313, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 12/10/2020 14:18:03\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.\r\rGanador de la loteria: luna3471 , créditos ganados: 5750', NULL, 3, '', '', '', '', '2020-10-12', NULL, NULL),
(314, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos.\rAtrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 15/10/2020 14:18:04\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-10-12', NULL, NULL),
(315, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers.\rLos ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-10-12', NULL, NULL),
(316, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco.\rLos ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-10-15', NULL, NULL),
(317, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 19/10/2020 14:18:03\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.\r\rGanador de la loteria: luna3471 , créditos ganados: 5250', NULL, 3, '', '', '', '', '2020-10-19', NULL, NULL),
(318, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja.\rAtrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 22/10/2020 14:18:04\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-10-19', NULL, NULL),
(319, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers.\rLos ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-10-19', NULL, NULL),
(320, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens.\rLos ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-10-22', NULL, NULL),
(321, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 26/10/2020 14:18:02\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.\r\rGanador de la loteria: villain , créditos ganados: 5250', NULL, 3, '', '', '', '', '2020-10-26', NULL, NULL),
(322, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos.\rAtrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 29/10/2020 14:18:04\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-10-26', NULL, NULL),
(323, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers.\rLos ganadores de la semana fueron\r\r1. Dylan\r2. Ichigo\r3. Gami\r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-10-26', NULL, NULL),
(324, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco.\rLos ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-10-29', NULL, NULL),
(325, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 02/11/2020 14:18:03\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.\r\rGanador de la loteria: Dylan , créditos ganados: 5250', NULL, 3, '', '', '', '', '2020-11-2', NULL, NULL),
(326, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja.\rAtrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 05/11/2020 14:18:04\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-11-2', NULL, NULL),
(327, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers.\rLos ganadores de la semana fueron\r\r1. Dylan\r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-11-2', NULL, NULL),
(328, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens.\rLos ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-11-5', NULL, NULL),
(329, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 09/11/2020 14:18:03\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.\r\rGanador de la loteria: Dylan , créditos ganados: 5250', NULL, 3, '', '', '', '', '2020-11-9', NULL, NULL),
(330, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos.\rAtrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 12/11/2020 14:18:04\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-11-9', NULL, NULL),
(331, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers.\rLos ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-11-9', NULL, NULL),
(332, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco.\rLos ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-11-12', NULL, NULL),
(333, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 16/11/2020 14:18:03\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo.\rEl ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2020-11-16', NULL, NULL),
(334, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja.\rAtrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 19/11/2020 14:18:04\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-11-16', NULL, NULL),
(335, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers.\rLos ganadores de la semana fueron\r\r1. Dylan\r2. clon6\r3. clon5\r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-11-16', NULL, NULL),
(336, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens.\rLos ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-11-19', NULL, NULL),
(337, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 23/11/2020 14:18:03\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.\r\rGanador de la loteria: RS5 , créditos ganados: 6750', NULL, 3, '', '', '', '', '2020-11-23', NULL, NULL),
(338, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos.\rAtrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 26/11/2020 14:18:04\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-11-23', NULL, NULL),
(339, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers.\rLos ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-11-23', NULL, NULL),
(340, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco.\rLos ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-11-26', NULL, NULL),
(341, '¡Catalago Viernes!', 'Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.', NULL, 3, '', '', '', '', '2020-11-27', NULL, NULL),
(342, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 30/11/2020 14:18:03\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo.\rEl ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2020-11-30', NULL, NULL),
(343, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja.\rAtrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 03/12/2020 14:18:04\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-11-30', NULL, NULL),
(344, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers.\rLos ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-11-30', NULL, NULL),
(345, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens.\rLos ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-12-3', NULL, NULL);
INSERT INTO `noticias` (`id`, `titulo`, `contenido`, `image`, `tipo_plantilla`, `url_1`, `url_2`, `url_3`, `url_4`, `fecha`, `created_at`, `updated_at`) VALUES
(346, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 07/12/2020 14:18:03\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.\r\rGanador de la loteria: DavidRIG , créditos ganados: 5250', NULL, 3, '', '', '', '', '2020-12-7', NULL, NULL),
(347, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos.\rAtrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 10/12/2020 14:18:04\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-12-7', NULL, NULL),
(348, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers.\rLos ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-12-7', NULL, NULL),
(349, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco.\rLos ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2020-12-10', NULL, NULL),
(350, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 14/12/2020 14:18:03\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo.\rEl ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2020-12-14', NULL, NULL),
(351, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja.\rAtrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 17/12/2020 14:18:04\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2020-12-14', NULL, NULL),
(352, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers.\rLos ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2020-12-14', NULL, NULL),
(355, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 21/12/2020 14:18:03\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo.\rEl ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2021-1-14', NULL, NULL),
(356, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos.\rAtrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 17/01/2021 9:53:43\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2021-1-14', NULL, NULL),
(357, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers.\rLos ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2021-1-14', NULL, NULL),
(358, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco.\rLos ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2021-1-17', NULL, NULL),
(359, '¡Resultados evento de Coco!', 'Gracias a todos los usuarios que participaron en el evento de Coco.\rLos ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2021-1-18', NULL, NULL),
(360, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 21/01/2021 9:53:43\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo.\rEl ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2021-1-24', NULL, NULL),
(361, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja.\rAtrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 27/01/2021 11:31:33\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2021-1-24', NULL, NULL),
(362, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers.\rLos ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2021-1-24', NULL, NULL),
(363, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens.\rLos ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2021-1-28', NULL, NULL),
(364, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 10/02/2021 8:36:57\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo.\rEl ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2021-2-3', NULL, NULL),
(365, '¡Regresa evento de Cocos!', 'Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos.\rAtrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: 06/02/2021 8:36:57\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2021-2-3', NULL, NULL),
(366, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers.\rLos ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2021-2-3', NULL, NULL),
(367, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 26/02/2021 16:25:04\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo.\rEl ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2021-2-19', NULL, NULL),
(368, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja.\rAtrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 22/02/2021 16:25:04\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2021-2-19', NULL, NULL),
(369, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers.\rLos ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2021-2-19', NULL, NULL),
(370, '¡Loteria ha terminado!', 'Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - 12/07/2021 6:51:02\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo.\rEl ticket se localiza en el Set News y su valor es de 2.000 créditos.', NULL, 3, '', '', '', '', '2021-7-13', NULL, NULL),
(371, '¡Regresa evento de Shurikens!', 'Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja.\rAtrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: 16/07/2021 14:38:59\rEscribe en chat /evento para ver el ranking.', NULL, 3, '', '', '', '', '2021-7-13', NULL, NULL),
(372, '¡Resultados Upper Semanal!', 'Gracias a todos los usuarios que participaron en el semanal de Uppers.\rLos ganadores de la semana fueron\r\r1. \r2. \r3. \r\rUsa comando /upper_semanal para ver el Ranking.', NULL, 3, '', '', '', '', '2021-7-13', NULL, NULL),
(373, '¡Resultados evento de Shurikens!', 'Gracias a todos los usuarios que participaron en el evento de Shurikens.\rLos ganadores del evento fueron\r\r1. \r2. \r3. \r\rLos premios se guardan en la mochila automáticamente.', NULL, 3, '', '', '', '', '2021-7-17', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `object_npc`
--

CREATE TABLE `object_npc` (
  `id` int(11) NOT NULL,
  `sala_id` int(11) NOT NULL DEFAULT 0,
  `gold` int(11) NOT NULL DEFAULT 0,
  `silver` int(11) NOT NULL DEFAULT 0,
  `obj_id` int(11) NOT NULL DEFAULT 0,
  `function` int(11) NOT NULL DEFAULT 0,
  `mochila` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `object_npc`
--

INSERT INTO `object_npc` (`id`, `sala_id`, `gold`, `silver`, `obj_id`, `function`, `mochila`) VALUES
(46, 30, 20000, 0, 540, 0, 1),
(49, 30, 0, 15000, 680, 0, 1),
(51, 30, 50000, 0, 762, 0, 1),
(52, 26, 15000, 0, 767, 0, 1),
(53, 26, 15000, 0, 726, 0, 1),
(54, 26, 20000, 0, 753, 0, 1),
(55, 26, 15000, 0, 708, 0, 1),
(56, 26, 15000, 0, 701, 0, 1),
(57, 26, 15000, 0, 694, 0, 1),
(58, 26, 15000, 0, 682, 0, 1),
(59, 26, 15000, 0, 675, 0, 1),
(60, 26, 15000, 0, 674, 0, 1),
(61, 26, 15000, 0, 756, 0, 1),
(62, 50, 0, 1000, 730, 0, 1),
(63, 50, 5000, 0, 671, 0, 1),
(64, 50, 20000, 0, 748, 0, 1),
(65, 55, 0, 100, 732, 0, 1),
(66, 55, 0, 100, 733, 0, 1),
(67, 55, 0, 100, 734, 0, 1),
(68, 55, 0, 100, 735, 0, 1),
(69, 55, 0, 100, 736, 0, 1),
(70, 71, 0, 100, 737, 0, 1),
(71, 71, 0, 100, 738, 22, 1),
(72, 55, 0, 100, 739, 22, 1),
(73, 55, 0, 100, 740, 23, 1),
(74, 46, 0, 1000, 1336, 23, 1),
(75, 46, 0, 1000, 1310, 23, 1),
(76, 46, 0, 1000, 764, 23, 1),
(77, 46, 20000, 0, 752, 0, 1),
(78, 46, 50000, 0, 692, 0, 1),
(79, 46, 0, 1000, 691, 0, 1),
(80, 38, 0, 1000, 731, 0, 1),
(81, 38, 50000, 0, 750, 0, 1),
(82, 38, 20000, 0, 728, 0, 1),
(83, 52, 20000, 0, 1174, 0, 1),
(84, 52, 5000, 0, 729, 0, 1),
(85, 52, 10000, 0, 212, 20, 1),
(86, 52, 20000, 0, 129, 20, 1),
(89, 63, 20000, 0, 880, 0, 1),
(90, 63, 30000, 0, 821, 0, 1),
(91, 63, 10000, 0, 826, 0, 1),
(92, 63, 50000, 0, 825, 0, 1),
(93, 64, 25000, 0, 869, 0, 1),
(94, 64, 20000, 0, 865, 0, 1),
(95, 64, 50000, 0, 834, 0, 1),
(96, 64, 50000, 0, 833, 0, 1),
(97, 71, 100, 0, 3057, 0, 1),
(98, 71, 100, 0, 3058, 0, 1),
(99, 71, 100, 0, 3056, 0, 1),
(100, 71, 100, 0, 3054, 0, 1),
(101, 71, 100, 0, 3059, 0, 1),
(102, 74, 50000, 0, 335, 0, 1),
(103, 74, 20000, 0, 824, 0, 1),
(104, 74, 20000, 0, 823, 0, 1),
(105, 74, 20000, 0, 822, 0, 1),
(106, 74, 100, 0, 1036, 0, 1),
(107, 74, 10000, 0, 317, 0, 1),
(108, 74, 10000, 0, 318, 0, 1),
(109, 74, 50000, 0, 839, 0, 1),
(110, 73, 100, 0, 1042, 0, 1),
(111, 73, 20000, 0, 556, 0, 1),
(112, 73, 20000, 0, 664, 0, 1),
(113, 95, 20000, 0, 586, 0, 1),
(114, 95, 10000, 0, 397, 0, 1),
(115, 95, 0, 100, 293, 0, 1),
(116, 86, 0, 5000, 444, 0, 1),
(117, 86, 0, 1000, 286, 0, 1),
(118, 86, 0, 5000, 285, 0, 1),
(119, 83, 0, 1000, 274, 0, 1),
(120, 83, 0, 1000, 275, 0, 1),
(121, 83, 0, 1000, 276, 0, 1),
(122, 84, 20000, 0, 361, 0, 1),
(123, 84, 20000, 0, 359, 0, 1),
(124, 84, 20000, 0, 355, 0, 1),
(125, 87, 1000, 0, 441, 0, 1),
(126, 87, 20000, 0, 479, 0, 1),
(127, 87, 0, 1000, 450, 0, 1),
(128, 19, 0, 20000, 918, 0, 1),
(129, 19, 0, 20000, 58, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `object_npc_id`
--

CREATE TABLE `object_npc_id` (
  `id` int(11) NOT NULL,
  `obj_id` int(11) NOT NULL DEFAULT 0,
  `sk_obj_id` int(11) NOT NULL DEFAULT 0 COMMENT 'Para conseguir',
  `obj_cantidad` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `object_npc_id`
--

INSERT INTO `object_npc_id` (`id`, `obj_id`, `sk_obj_id`, `obj_cantidad`) VALUES
(39, 540, 547, 1),
(40, 540, 545, 1),
(41, 540, 543, 1),
(42, 540, 542, 1),
(43, 540, 546, 1),
(44, 540, 544, 1),
(46, 680, 755, 15),
(47, 680, 758, 5),
(48, 680, 759, 2),
(49, 762, 720, 25),
(50, 767, 757, 5),
(51, 767, 754, 5),
(52, 756, 761, 5),
(53, 756, 720, 10),
(54, 753, 761, 5),
(55, 753, 758, 5),
(56, 726, 721, 10),
(57, 726, 755, 5),
(58, 708, 755, 10),
(59, 701, 761, 10),
(60, 701, 544, 5),
(61, 694, 755, 5),
(62, 694, 757, 10),
(63, 682, 721, 10),
(64, 682, 720, 5),
(65, 675, 542, 5),
(66, 675, 758, 5),
(67, 674, 720, 5),
(68, 674, 761, 5),
(69, 730, 546, 50),
(70, 671, 543, 50),
(71, 748, 545, 50),
(72, 732, 759, 10),
(73, 733, 757, 10),
(74, 734, 755, 10),
(75, 735, 754, 10),
(76, 736, 761, 10),
(77, 737, 315, 10),
(78, 738, 315, 10),
(79, 739, 755, 10),
(80, 740, 761, 10),
(81, 1336, 547, 50),
(82, 1310, 720, 50),
(83, 764, 721, 50),
(84, 752, 543, 50),
(85, 692, 720, 50),
(86, 691, 721, 50),
(87, 731, 761, 10),
(88, 750, 544, 50),
(89, 728, 547, 50),
(90, 1174, 720, 10),
(91, 729, 721, 10),
(92, 212, 720, 10),
(93, 129, 757, 50),
(94, 880, 819, 25),
(95, 821, 315, 20),
(96, 826, 315, 10),
(97, 825, 819, 15),
(98, 869, 819, 10),
(99, 865, 315, 15),
(100, 834, 819, 10),
(101, 833, 819, 15),
(102, 3057, 819, 25),
(103, 3058, 819, 25),
(104, 3056, 819, 25),
(105, 3054, 819, 25),
(106, 3059, 819, 25),
(107, 335, 315, 50),
(108, 824, 315, 50),
(109, 823, 315, 50),
(110, 822, 315, 50),
(111, 1036, 315, 10),
(112, 317, 315, 50),
(113, 318, 315, 50),
(114, 839, 315, 50),
(115, 1042, 819, 15),
(116, 556, 819, 20),
(117, 664, 819, 25),
(118, 586, 118, 50),
(119, 397, 118, 50),
(120, 293, 118, 50),
(121, 444, 118, 50),
(122, 286, 118, 50),
(123, 285, 118, 25),
(124, 274, 118, 25),
(125, 275, 118, 25),
(126, 276, 118, 25),
(127, 361, 118, 15),
(128, 359, 118, 15),
(129, 355, 118, 15),
(130, 441, 118, 10),
(131, 479, 118, 10),
(132, 450, 118, 10),
(133, 918, 541, 50),
(134, 58, 541, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetos`
--

CREATE TABLE `objetos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(500) NOT NULL DEFAULT 'Título',
  `descripcion` varchar(250) NOT NULL DEFAULT 'Descripción',
  `Especial` varchar(233) NOT NULL COMMENT 'Trofeo,concurso,pocion,',
  `colores_mal` varchar(233) NOT NULL,
  `swf` varchar(250) NOT NULL,
  `categoria` varchar(233) NOT NULL DEFAULT '1',
  `visible` int(11) NOT NULL DEFAULT 0,
  `visible_mod` int(11) NOT NULL DEFAULT 0,
  `precio_oro` int(11) NOT NULL DEFAULT -1,
  `oro_descuento` int(11) NOT NULL DEFAULT 0,
  `precio_plata` int(11) NOT NULL DEFAULT -1,
  `vip` int(11) NOT NULL DEFAULT 0,
  `espacio_mapabytes` int(11) NOT NULL DEFAULT 0,
  `colores_hex` varchar(500) DEFAULT ' ',
  `colores_rgb` varchar(500) DEFAULT ' ',
  `parte_1` varchar(15) NOT NULL DEFAULT 'parte_1',
  `parte_2` varchar(15) NOT NULL DEFAULT 'parte_2',
  `parte_3` varchar(15) NOT NULL DEFAULT 'parte_3',
  `parte_4` varchar(15) NOT NULL DEFAULT 'parte_4',
  `tam_p` varchar(3) NOT NULL DEFAULT '0',
  `tam_n` varchar(3) NOT NULL DEFAULT '1',
  `espacio_ocupado_n` varchar(500) NOT NULL,
  `espacio_2_0` varchar(500) NOT NULL,
  `tam_g` varchar(3) NOT NULL DEFAULT '0',
  `something_4` int(11) NOT NULL,
  `something_5` int(11) NOT NULL,
  `something_6` int(11) NOT NULL,
  `arrastrable` varchar(11) NOT NULL DEFAULT '1' COMMENT '0 = No arrastrable; 1 = Arrastrable',
  `salas_usables` varchar(3) NOT NULL DEFAULT '1³0' COMMENT '1 = Islas; 3 = Casas',
  `intercambiable` int(11) NOT NULL DEFAULT 1,
  `tipo_rare` int(11) NOT NULL DEFAULT 0 COMMENT 'No Rare = 0; Unico = 1; Casi Unico = 2; Muy Rare = 3; Rare = 4',
  `rotacion` int(11) NOT NULL DEFAULT 1,
  `tipo_arrastre` int(11) NOT NULL DEFAULT 0 COMMENT '0 = Decorativo; 1 = Desconocido; 2 = Planta; 4 = Aire',
  `Definicion` varchar(54) NOT NULL,
  `default_data` varchar(150) NOT NULL DEFAULT '0',
  `limitado` int(11) NOT NULL DEFAULT 0,
  `ofertas` int(11) NOT NULL DEFAULT 0,
  `precio_anterior` int(11) NOT NULL DEFAULT -1,
  `efecto_id` tinyint(3) UNSIGNED DEFAULT NULL,
  `tiempo_pocion` smallint(5) UNSIGNED DEFAULT NULL,
  `img` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `objetos`
--

INSERT INTO `objetos` (`id`, `titulo`, `descripcion`, `Especial`, `colores_mal`, `swf`, `categoria`, `visible`, `visible_mod`, `precio_oro`, `oro_descuento`, `precio_plata`, `vip`, `espacio_mapabytes`, `colores_hex`, `colores_rgb`, `parte_1`, `parte_2`, `parte_3`, `parte_4`, `tam_p`, `tam_n`, `espacio_ocupado_n`, `espacio_2_0`, `tam_g`, `something_4`, `something_5`, `something_6`, `arrastrable`, `salas_usables`, `intercambiable`, `tipo_rare`, `rotacion`, `tipo_arrastre`, `Definicion`, `default_data`, `limitado`, `ofertas`, `precio_anterior`, `efecto_id`, `tiempo_pocion`, `img`) VALUES
(1, 'Saco Oro x 100', 'Saco de 100 monedas de oro', '', '', '100oro', '8', 0, 1, -1, 0, 200, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(2, 'Saco Oro x 500', 'Saco de 500 monedas de oro', '', '', '500oro', '8', 0, 1, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(3, 'Explosivo 5º Aniv.', '', '', '', 'abb_acme', '8', 1, 1, 20000, 16000, -1, 0, 0, 'EA1719', '72,72,92', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 12, '', '0', 0, 0, -1, NULL, NULL, 1),
(4, 'Bomba 5º Aniv.', '', '', '', 'abb_bomb', '8', 1, 0, -1, 0, 200, 0, 0, 'A9AFAFFF4955', '72,72,69,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 12, '', '0', 0, 0, -1, NULL, NULL, 1),
(5, 'Dinamita 5º Aniv.', '', '', '', 'abb_bundle', '8', 1, 1, 20000, 16000, -1, 0, 0, 'EA1719', '72,72,92', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 12, '', '0', 0, 0, -1, NULL, NULL, 1),
(6, 'Seto 5º Aniv.', '', '', '', 'abb_bush', '8', 1, 1, 20000, 16000, -1, 0, 0, 'C49C69ABF264FF44A857B2FF', '72,72,77,72,72,95,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(7, 'Pastel 5º Aniv.', '', '', '', 'abb_cake', '8', 1, 0, -1, 0, 500, 0, 0, 'FF3D78F2486A6DE88F5A97FF', '72,72,100,72,72,95,72,72,91,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(8, 'Globo Bisonte', '', '', '', 'abb_globoAnimal', '8', 1, 0, -1, 0, 200, 0, 0, 'FF8E34ACBAB0', '72,72,100,72,72,73', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 8, '', '0', 0, 0, -1, NULL, NULL, 0),
(9, 'Globo 5º Aniv.', '', '', '', 'abb_globoFive', '8', 1, 0, -1, 0, 200, 0, 0, '58FFABACBAB0', '72,72,100,72,72,73', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 8, '', '0', 0, 0, -1, NULL, NULL, 1),
(10, 'Globo V', '', '', '', 'abb_globoMano', '8', 1, 0, -1, 0, 200, 0, 0, '3D53E0739691', '72,72,88,72,72,59', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 8, '', '0', 0, 0, -1, NULL, NULL, 0),
(11, 'Globo Estrella', '', '', '', 'abb_globoStar', '8', 1, 0, -1, 0, 200, 0, 0, 'E046B7ACBAB0', '72,72,88,72,72,73', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 8, '', '0', 0, 0, -1, NULL, NULL, 0),
(15, 'TNT 5º Aniv', '', '', '', 'abb_tnt', '8', 1, 1, 20000, 16000, -1, 0, 0, 'EA17197A6C72', '72,72,92,72,72,48', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 12, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(16, 'Abeja', 'Puede que se trate de una abeja virtual', '', '', 'abeja', '2', 1, 0, -1, 0, 25, 0, 0, 'FEF70F', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 8, '', '0', 0, 0, -1, NULL, NULL, 1),
(18, 'Robot Cucaracha', 'No es muy simpático', '', '', 'alien_bug', '9', 1, 0, -1, 0, 1000, 0, 0, 'B7949AEACDDCC1BBBE', '72,72,72,72,72,92,72,72,76', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 10, '', '0', 0, 0, -1, NULL, NULL, 1),
(19, 'Flor Vega 05', 'Nos cuenta que en su planeta es normal plantar humanos en macetas.', '', '', 'alien_flower', '9', 1, 0, -1, 0, 200, 0, 0, 'A6BA71F7A73E', '72,72,73,72,72,97', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 12, '', '0', 0, 0, -1, NULL, NULL, 1),
(20, 'Ojo Guardian', 'No le mires fijamente por si acaso...', '', '', 'alien_flower_2', '9', 1, 0, -1, 0, 500, 0, 0, 'E8D1C9B2EAB8FF9BAF', '72,72,91,72,72,92,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(21, 'Flor Quaoar', 'La hemos traido de los viveros de Quaoar', '', '', 'alien_flower_3', '9', 1, 0, -1, 0, 1000, 0, 0, 'FFA8E4FF92BBFFE456', '72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0,0,1,-1,0,0,-1,-1,-1,1,1', '0,0,-1,-1,-1,0,-1,1,0,1,1,0,0,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(22, 'Amanita Ufoide', 'Mitad seta', '', '', 'alien_flower_4', '9', 1, 0, -1, 0, 600, 0, 0, 'F7FFEBFF5BECEA5723', '72,72,100,72,72,100,72,72,92', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,1,0,1,0,-1,-1,-1,1,0', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(23, 'UFO', 'En exclusiva para Boombang', '', '', 'alien_fly_sauce', '9', 0, 0, -1, 0, 2000, 0, 0, 'B0E5CAD1C0C7D668B0', '72,72,90,72,72,82,72,72,84', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 14, '', '0', 0, 0, -1, NULL, NULL, 1),
(24, 'Meteorito', '4.564.345 kilos de piedra extra-terrestre.', '', '', 'alien_meteor', '9', 1, 0, -1, 0, 100, 0, 0, 'D6C2C2', '72,72,84', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(40, 'Ithoriano', 'Vino para estudiarnos un tiempo pero se quedó prendado con nuestros bizcochos y chocolate.', '', '', 'alien_person', '9', 1, 0, -1, 0, 1000, 0, 0, 'B591746EB8DBED9135CCAA96', '72,72,71,72,72,86,72,72,93,72,72,80', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '', '0', 0, 0, -1, NULL, NULL, 1),
(41, 'Robot 3 en 1', 'Malhumorado Aspirador-Microondas-Licuadora último modelo. Latón Inoxidable.', '', '', 'alien_robot_vol', '9', 1, 0, -1, 0, 1000, 0, 0, 'D1CAD3FF61A2', '72,72,83,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 8, '', '0', 0, 0, -1, NULL, NULL, 1),
(42, 'Icarus', 'Ideal para montar Conspiraciones Interplanetarias y Revoluciones Galácticas', '', '', 'alien_ship_arm', '9', 1, 1, 20000, 16000, -1, 0, 0, '79E6FFE579B49FE89EBAE1FF', '72,72,100,72,72,90,72,72,91,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 4, '', '0', 0, 0, -1, NULL, NULL, 1),
(43, 'Spaceball', 'Elevalunas eléctrico aire acondicionado', '', '', 'alien_ship_cras', '9', 1, 0, -1, 0, 2000, 0, 0, 'E9F8FF7FFFF6', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0,2,0,2,1,3,1,3,2,2,2,1,1,0,-1,1,-1,0,-2,-1,-1,-1,-2,-2,-2,-2,-3,-1,-3', '0,0,1,0,2,0,0,-1,1,-2,-2,-2,-1,-2,0,-2,-2,-3', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(44, 'DaShuttle', 'Esperemos que lleve bolsas para el mareo a bordo.', '', '', 'alien_ship_ovi', '9', 1, 0, -1, 0, 2000, 0, 0, 'C194AA5D9EDB6FB727DBC436', '72,72,76,72,72,86,72,72,72,72,72,86', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 4, '', '0', 0, 0, -1, NULL, NULL, 1),
(45, 'alien_ship_rot', 'Descripción', '', '', 'alien_ship_rot', '9', 1, 0, -1, 0, 5000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(46, 'TeleShuttle', 'Se volatiliza y desaparece', '', '', 'alien_ship_sat', '9', 1, 0, -1, 0, 1000, 0, 0, 'C7E5E1C2DBD0CEAEC1DCD4DD', '72,72,90,72,72,86,72,72,81,72,72,87', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 8, '', '0', 0, 0, -1, NULL, NULL, 1),
(47, 'Ancla', '¡Evitará que los tornados arrastren tu isla!', '', '', 'ancla', '1', 1, 0, -1, 0, 20, 0, 0, '3E65A7', '72,72,66', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(48, 'Cupido', 'Cupido es tu mejor aliado para que se fijen en ti!', '', '', 'angelito', '7', 1, 0, -1, 0, 1000, 0, 0, 'ABD8FEFED79AFCFE97', '72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 10, '', '0', 0, 0, -1, NULL, NULL, 1),
(49, 'Árbol de navidad', 'Entrañable! imprescindible para iluminar estos días!', '', '', 'arbolnav', '6', 1, 0, -1, 0, 100, 0, 0, '904E1B367F23FEFA4A', '72,72,57,72,72,50,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(50, 'Árbol de navidad [NPC]', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', '', '', 'arbolnav2', '6', 0, 0, -1, 0, 1500, 0, 0, '99511083F70C', '72,72,60,72,72,97', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(51, 'Andy', 'Una ardilla muy lista', '', '', 'ardilla', '2', 1, 1, 20000, 16000, -1, 0, 0, 'EF9323', '72,72,94', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 9, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(52, 'Flecha de Cupido', 'Cupido', '', '', 'arrow', '7', 1, 0, -1, 0, 25, 0, 0, '979963CBC8CED1C4AA7A724A', '72,72,60,72,72,81,72,72,82,72,72,48', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(53, 'Egg Bohemio', '', '', '', 'art_beret', '15', 1, 1, 100000, 80000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(54, 'Royal Art Egg', '', '', '', 'art_crown', '15', 1, 1, 200000, 160000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 1, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(55, 'Art Egg', '', '', '', 'art_egg', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(56, 'Globo-Corazón', '¿Sientes que flotas como un globo? Estas enamorad@!', '', '', 'ballon', '7', 1, 0, -1, 0, 500, 0, 0, 'FF8091FFE4B3', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 8, '', '0', 0, 0, -1, NULL, NULL, 1),
(57, 'Globamor', '', '', '', 'Balloon_Love', '7', 0, 0, -1, 0, 10000, 1, 0, 'F74E63D13B40BF998D88D3D3', '72,72,97,72,72,82,72,72,75,72,72,83', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 14, '', '0', 0, 0, -1, NULL, NULL, 1),
(58, '8PS', '', '', '', 'ballRobot', '9', 0, 1, -1, 0, 20000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(59, 'Banana', '¿Dónde está el mono?', '', '', 'banana', '1', 1, 0, -1, 0, 10, 0, 0, 'FED51F', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(60, 'Viejo Roble', 'Eso que cuelga es un panal de avispas..... Ni se te ocurra acercarte!!!', '', '', 'barbol', '2', 1, 0, -1, 0, 500, 0, 0, 'CB248051322B2D4406', '72,72,80,72,72,32,72,72,27', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,0,0,1,1,0,1,1,-1,-1,0,-1,-2,0', '0,0,0,-1,1,0,1,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(61, 'Barril de amor', '!Estamos convencidos que el amor es mas explosivo que la pólvora!', '', '', 'barrilCorazones', '7', 1, 0, -1, 0, 300, 0, 0, 'D89C66F7241CB3BCADFF2916', '72,72,85,72,72,97,72,72,74,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 12, '', '0', 0, 0, -1, NULL, NULL, 1),
(62, 'Cometa', '', '', '', 'barrilete', '8', 1, 0, -1, 0, 1500, 0, 0, '7AB517F9B564FF5656', '72,72,71,72,72,98,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 8, '', '0', 0, 0, -1, NULL, NULL, 1),
(63, 'Cometa Dragón', '', '', '', 'barrilete2', '8', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(64, 'Murcielaguito', 'Puede que sean diminutos pero son astutos y siempre se mueven en grandes grupos...', '', '', 'bat1', '4', 1, 0, -1, 0, 10, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(65, 'Murcielaguito', 'Puede que sean diminutos pero son astutos y siempre se mueven en grandes grupos...', '', '', 'bat2', '4', 1, 0, -1, 0, 10, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(67, 'baticao', 'Descripción', '', '', 'baticao', '300', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(68, '5 BBox', 'Con BBox', '', '', 'bbox_pack_5', '6', 1, 0, -1, 0, 500, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(69, '10 BBox', 'Con BBox', '', '', 'bbox_pack_10', '6', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(70, '20 BBox', 'Con BBox', '', '', 'bbox_pack_20', '6', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(71, '50 BBox', 'Con BBox', '', '', 'bbox_pack_50', '6', 1, 0, -1, 0, 5000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(73, '10 BBox Columnas', 'Lo que necesitabas para coronar tu construcción.', '', '', 'bbox_pack_iceColumns', '6', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(74, '10 BBox Cruz', 'Da forma y textura a tus construcciones de hielo.', '', '', 'bbox_pack_iceCross', '6', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(76, '10 BBox Pirámide', 'Completa la construcción de tus sueños con Pirámides de hielo.', '', '', 'bbox_pack_icePiramid', '6', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(77, '10 BBox Esfera', 'Da un toque futurista a tus estructuras con la Esfera de hielo.', '', '', 'bbox_pack_iceSphere', '6', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(78, '10 BBox Cilindro', 'Columnas', '', '', 'bbox_pack_iceVCilinder', '6', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(79, 'BBox Columnas', 'Lo que necesitabas para coronar tu construcción.', '', '', 'BboxIceColumns', '6', 1, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(80, 'BBox Cruz', 'Da forma y textura a tus construcciones.', '', '', 'BboxIceCross', '6', 1, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(81, 'BBox Pez', 'Un rato especimen que se quedó congelado.', '', '', 'BboxIceFish', '6', 1, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(82, 'BBox Rana', 'El fin de una rana que se metió donde no la llamaban.', '', '', 'BboxIceFrog', '6', 1, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(83, 'BBoxIceHCilinder', 'BBoxIceHCilinder', '', '', 'BboxIceHCilinder', '6', 1, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(84, 'BBox Corazón', 'El latido de un enamorado se quedó para siempre congelado en este BBox.', '', '', 'BboxIceHeart', '6', 1, 1, 100000, 80000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 2, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(85, 'BBox Pirámide', 'Completa la construcción de tus sueños con Pirámides.', '', '', 'BboxIcePiramid', '6', 1, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(86, 'BBox Esfera', 'Da un toque futurista a tus estructuras con la Esfera.', '', '', 'BboxIceSphere', '6', 1, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(87, 'BBox Cilindro', 'Columnas', '', '', 'BboxIceVCilinder', '6', 1, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(93, 'Furgoneta', 'Furgoneta Ben10', '', '', 'Ben10_Furgoneta', '300', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,1,-1,2,-1,3,0,3,1,3,2,3,-1,0,-1,-1,-1,-2,-1,-3,0,-3,1,2,1,1,2,2,2,1,1,0,1,-1,1,-2,0,-2,0,-1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(94, 'Ben10_Watch', 'Descripción', '', '', 'Ben10_Watch', '300', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(95, 'BMX', '', '', '', 'bicicleta', '8', 1, 0, -1, 0, 1500, 0, 0, '635B63EAD336282826', '72,72,39,72,72,92,72,72,16', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,0,1,0', '0,0,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(96, 'Aerial', '', '', '', 'blueAlien', '9', 1, 0, -1, 0, 20000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(97, 'Aerial Senior', '', '', '', 'blueAlienRare', '9', 1, 1, 20000, 16000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(98, 'Boing Tv', '', '', '', 'Boing_Tv', '300', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,1,-1,0,1,0,0,-1,1,1,1,-1,-1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(99, 'Keko-bola Boomer', 'Mira la textura de esta bola', '', '', 'bola_boomer', '1', 1, 0, -1, 0, 600, 0, 0, 'FFB775', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 10, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(100, 'Keko-bola Bruja', '¿Eres una bruja o estás pensando en mutar en una? Entonces este es tu adorno navideño.', '', '', 'bola_bruja', '1', 1, 0, -1, 0, 600, 0, 0, 'C8FFAA', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 10, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(101, 'Keko-bola Mafioso', '¿Seguro que quieres que todo el mundo sepa que eres un Mafioso?', '', '', 'bola_cholo', '1', 1, 0, -1, 0, 600, 0, 0, 'FF7C92', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 10, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(102, 'Keko-bola Empollón', 'Estas navidades', '', '', 'bola_empollon', '1', 1, 0, -1, 0, 600, 0, 0, 'FFF36F', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 10, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(103, 'Keko-bola Gata', 'Para decorar tu isla y tu casita sin necesidad de árbol. Eficacia garantizada.', '', '', 'bola_gata', '1', 1, 0, -1, 0, 600, 0, 0, '49F5FF', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 10, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(104, 'Keko-bola India', 'La mejor manera de inmortalizar un recuerdo en tu isla. Coloréala a tu gusto.', '', '', 'bola_india', '1', 1, 0, -1, 0, 600, 0, 0, 'ABFFB7', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 10, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(105, 'Keko-bola Liliam', 'Cuando se trata de convertirse en adorno', '', '', 'bola_lilian', '1', 1, 0, -1, 0, 600, 0, 0, 'FF91F1', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 10, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(106, 'Keko-bola Marsu', '¿Por qué no das un toque personal a tu isla? Elige la bola de tu keko y píntala.', '', '', 'bola_marsu', '1', 1, 0, -1, 0, 600, 0, 0, 'CDF5FF', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 10, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(107, 'Keko-bola DJ', 'Estas navidades', '', '', 'bola_modern', '1', 1, 0, -1, 0, 600, 0, 0, 'FF2EBF', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 10, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(108, 'Keko-bola Ninja', 'Que todo el mundo sepa quién es el verdadero Ninja.', '', '', 'bola_ninja', '1', 1, 0, -1, 0, 600, 0, 0, '3A0D09', '72,72,23', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 10, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(109, 'Keko-bola Rastas', 'Coloreable y navideño. El Rastas como nunca lo habías visto.', '', '', 'bola_rasta', '1', 1, 0, -1, 0, 600, 0, 0, '795DFF', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 10, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(110, 'Bola de Navidad', 'Tan simple pero a la vez tan entrañable. Coloréalas e inunda tu isla con ellas.', '', '', 'bola_sola', '1', 1, 0, -1, 0, 200, 0, 0, 'FF7C92', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 10, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(111, 'Keko-bola Yayo', '¡Shhh! No se lo digas a nadie', '', '', 'bola_yayo', '1', 1, 0, -1, 0, 600, 0, 0, 'F8FFF2', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 10, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(112, 'Ezekiel', '', '', '', 'bolaBuena', '1', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(113, 'Beelzebub', '', '', '', 'bolaMala', '1', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(114, 'Bongo', 'Tu fiel compañero en las laaaaargas e inolvidables veladas!', '', '', 'bongo', '5', 1, 0, -1, 0, 25, 0, 0, '327F36FAFEFB', '72,72,50,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(115, 'Gallina Clueca', 'Item requerido: x200 Setas Venenosas \"Busca Setas en La Madriguera\" ', '', '', 'Bosque_Chicken', '2', 1, 1, -1, -1, 5000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(116, 'Zorro Maligno', 'Item requerido: x200 Setas Venenosas \"Busca Setas en La Madriguera\" ', '', '', 'Bosque_Fox', '2', 1, 0, -1, 0, 1000, 0, 0, 'CCA88C', '72,72,80', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(117, 'Rana Saltarina', 'Item requerido: x200 Setas Venenosas \"Busca Setas en La Madriguera\"', '', '', 'Bosque_Rana', '2', 1, 0, -1, 0, 1000, 0, 0, '939640C6933196C970', '72,72,59,72,72,78,72,72,79', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(118, 'Seta Venenosa', '', 'concurso', '', 'Bosque_SetaVenenosa', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(119, 'Plaff', '¡No encuentra su casa! ¡Se le olvidó que la lleva a cuestas!Item requerido: x200 Setas Venenosas \"Busca Setas en La Madriguera\" ', '', '', 'Bosque_Snail', '2', 1, 1, 20000, 16000, -1, 0, 0, 'FEFCD9F9DAC3', '72,72,100,72,72,98', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 9, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(120, 'Botella', '¿Qué habrá en su interior? ¿Un mapa del tesoro? ¿Una carta de amor?', '', '', 'bottle', '1', 1, 0, -1, 0, 10, 0, 0, '316D10', '72,72,43', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(121, 'Seto Salvaje', 'Un esponjoso seto con frutos silvestres! Apuesto a que ya sabes para que sirve ;D', '', '', 'bush', '2', 1, 0, -1, 0, 5, 0, 0, '259D1DE42A3C', '72,72,62,72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(122, 'Corazón Verde', 'Amor ecologista', '', '', 'bush_valentine', '7', 1, 0, -1, 0, 25, 0, 0, 'E5B46ABA8C7CA87810A7E042', '72,72,90,72,72,73,72,72,66,72,72,88', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(123, 'Mariposa', 'Perfecta compañía para las que tienes en la cabeza.', '', '', 'butterfly', '2', 1, 0, -1, 0, 400, 0, 0, 'A5BF54EFD343CC2520', '72,72,75,72,72,94,72,72,80', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 8, '', '0', 0, 0, -1, NULL, NULL, 1),
(124, 'Caca', 'La mítica caca de Arale ;DD tranquilos, ¡no huele!', '', '', 'caca', '1', 1, 0, -1, 0, 2000, 0, 0, '9D560A', '72,72,62', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(125, 'cactus', 'Descripción', '', '', 'cactus', '1', 1, 0, -1, 0, 50, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(126, 'Regalo', 'A que esperas para ver lo que tiene dentro!!', '', '', 'cajitaSorpresa', '8', 0, 0, -1, 0, 1000, 0, 0, '11C12BFF1C17', '72,72,76,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 11, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(127, 'calabaza', 'Descripción', '', 'Si', 'calabaza', '4', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(128, 'Calabazaaargh!', 'Hay quien afirma que la calabaza tiene vida propia.', '', '', 'calabaza_house', '4', 1, 0, -1, 0, 6000, 0, 0, '13A74BFE6213B96F33', '72,72,66,72,72,100,72,72,73', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,-1,-1,-2,1,1,2,1,1,0,1,-1,0,-2,-1,-3,0,-3,-1,-4,0,-4,2,2,3,1,3,2,4,1,4,0,3,-1,2,-1,2,0,0,-1,1,-2,3,0,2,-2,1,-3,2,-3,3,-2,4,-1,1,-4,4,2,5,1,5,0,3,-3,4,-2,5,-1,2,-4,4,-3,3,-4,5,-2', '0,0,1,0,2,0,3,0,1,1,2,1,3,1,-1,-1,0,-1,1,-1,2,-1,3,-1,-1,-2,0,-2,1,-2,2,-2,-1,-3,0,-3,1,-3', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 2, '', '0', 0, 0, -1, NULL, NULL, 1),
(129, 'Mike Calabazeitor', 'Con él en tu isla', '', '', 'calabazeitor', '4', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(130, 'Cámara pirata', '', '', '', 'camaraPirata', '4', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(132, 'Dulce retina', 'Chupachups XXL', '', '', 'candie1', '4', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(133, 'Nube diabólica', 'candie', '', '', 'candie2', '4', 1, 0, -1, 0, 200, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(134, 'Ratón pegajoso', 'candie', '', '', 'candie3', '4', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(135, 'Piruleta infernal', 'candie', '', '', 'candie4', '4', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(136, 'Bastón del muerto', 'candie', '', '', 'candie5', '4', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(137, 'Caramelo fétido', 'candie', '', '', 'candie6', '4', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(139, 'Coche', 'Un modelo de coleccionista.', '', '', 'car', '1', 1, 0, -1, 0, 5000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(140, 'Caracola', 'Bonita ¿no? Pero... ¡cuidado con el huésped!', '', '', 'caracola', '1', 1, 0, -1, 0, 20, 0, 0, 'FE8301FEDA03', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(141, 'Carbón', '', '', '', 'carbon', '1', 1, 0, -1, 0, 1500, 0, 0, 'BBC1BED67B29', '72,72,76,72,72,84', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(142, 'Tienda camuflaje', 'Resguárdate del mal tiempo... y de otros peligros que acechan dentro de esta tienda', '', '', 'carpa', '2', 1, 0, -1, 0, 400, 0, 0, '669D33', '72,72,62', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,0,-2,0,-3,0,-3,1,-2,1,-1,1,0,1,1,1,-3,2,-2,2,-1,2,0,2,1,2,-3,-1,-2,-1,-1,-1,0,-1,1,-1', '-3,-1,-2,-1,-1,-1,0,-1,1,-1,-3,0,-2,0,-1,0,0,0,1,0,-3,1,-2,1,-1,1,0,1,1,1,-3,2,-2,2,-1,2,1,2', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 2, '', '0', 0, 0, -1, NULL, NULL, 0),
(143, 'Alfombra', 'Alfombra persa con pelo de trompa del Mamut de Ice Age.', '', '', 'carpet', '1', 1, 0, -1, 0, 50, 0, 0, 'BB401FFED590', '72,72,74,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', -300, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(144, 'Alfombra', '', '', '', 'Carpet02', '1', 1, 0, -1, 0, 1000, 0, 0, 'DDD3A7FFF253', '72,72,87,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', -500, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(145, 'carta', 'Descripción', '', 'Si', 'carta', '7', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(149, 'Llave Bronce', 'Con esta llave podrás abrir una de las puertas de tu casa. Cada puerta requiere una llave diferente!', 'npc', '', 'Casa_Bronze_Key', '17', 0, 1, -1, 0, 200, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(190, 'Caja Maldita', 'Obtendrás al abrir la caja 1 objeto de 5 posibles; todos ellos escalofriantes!', '', '', 'Casa_Present_Halloween', '4', 0, 0, -1, 0, 6000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(191, 'Caja Perversa', 'Obtendrás al abrirla 1 objeto de 5 posibles; todos ellos aterradores!', '', '', 'Casa_Present_Halloween1', '4', 0, 0, -1, 0, 200, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,0,1,1,1,-1,-1,1,0,0,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(210, 'Llave Madera', 'Con esta llave podrás abrir una de las puertas de tu casa. Cada puerta requiere una llave diferente!', 'npc', '', 'Casa_Wood_Key', '17', 0, 1, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(211, 'casco_buttowsky', 'Descripción', '', '', 'casco_buttowsky', '300', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(212, 'Gato Esqueleto', '', '', '', 'catBones', '4', 0, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(213, 'Caldero de Bruja', 'Ojos de sapo', '', '', 'cauldron', '4', 1, 0, -1, 0, 100, 0, 0, '7E9FD0395989BE58B7', '72,72,82,72,72,54,72,72,75', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(214, 'Césped con línea', 'Combínalo con los otros tipos de césped para crear formas a tu gusto.', '', '', 'cesped_normal', '1', 1, 0, -1, 0, 60, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', -50, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(220, 'Seta Gigante', 'Venenoso... mortal!... pero irresistible!', '', '', 'champignon', '2', 1, 0, -1, 0, 200, 0, 0, '18BE0808EAFEFEF309', '72,72,75,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(221, 'Carro Mani', '', '', '', 'cheetosCarrito', '300', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,-1,-1,0,-1,1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(222, 'Cartel', '', '', '', 'cheetosCartel', '300', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,-1,0,-2,-1,-1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(223, 'Cartel Cheetos', '', '', '', 'cheetosCartelL', '300', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,-1,0,-2,-1,-1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(224, 'ArbolCheet', '', '', '', 'cheetosCasaTree', '300', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,-1,-1,0,-1,-1,0,1,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(225, 'Columpio Cheeto', '', '', '', 'cheetosColumpio', '300', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 500, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(226, 'ElefantCheest', '', '', '', 'cheetosElefant', '300', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,-1,1,1,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(227, 'Grafitti Cheetos', '', '', '', 'cheetosGrafitti', '300', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', -300, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(228, 'Hamaca Cheetos', '', '', '', 'cheetosHamaca', '300', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 500, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(229, 'Chester', '', '', '', 'cheetosKeko', '300', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(230, 'Liana', '', '', '', 'cheetosLiana', '300', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 2000, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(231, 'Trapecio', '', '', '', 'cheetosTrapecio', '1', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,8,8', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(232, 'Devorador de Tesoros', '', '', '', 'chest_monster', '11', 1, 0, -1, 0, 5000, 1, 0, '71B6FF', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(233, 'Egg Bombilla', '', '', '', 'Choco_Bombilla', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(234, 'Trozo 1', '', 'concurso', '', 'Choco_Broken1', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(235, 'Trozo 2', '', 'concurso', '', 'Choco_Broken2', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(236, 'Trozo 3', '', 'concurso', '', 'Choco_Broken3', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(237, 'Trozo 4', '', 'concurso', '', 'Choco_Broken4', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(238, 'Trozo 5', '', 'concurso', '', 'Choco_Broken5', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(239, 'Trozo 6', '', 'concurso', '', 'Choco_Broken6', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(240, 'Trozo 7', '', 'concurso', '', 'Choco_Broken7', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(241, 'Trozo 8', '', 'concurso', '', 'Choco_Broken8', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(242, 'Trozo 9', '', 'concurso', '', 'Choco_Broken9', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(243, 'Trozo 10', '', 'concurso', '', 'Choco_Broken10', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(244, 'Trozo 11', '', 'concurso', '', 'Choco_Broken11', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(245, 'Trozo 12', '', 'concurso', '', 'Choco_Broken12', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(246, 'Trozo 13', '', 'concurso', '', 'Choco_Broken13', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(247, 'Trozo 14', '', 'concurso', '', 'Choco_Broken14', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(248, 'Trozo 15', '', 'concurso', '', 'Choco_Broken15', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(249, 'Trozo 16', '', 'concurso', '', 'Choco_Broken16', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(250, 'Trozo 17', '', 'concurso', '', 'Choco_Broken17', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(251, 'Trozo 18', '', 'concurso', '', 'Choco_Broken18', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(252, 'Trozo 19', '', 'concurso', '', 'Choco_Broken19', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(253, 'Trozo 20', '', 'concurso', '', 'Choco_Broken20', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(254, 'Trozo 21', '', 'concurso', '', 'Choco_Broken21', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(255, 'Trozo 22', '', 'concurso', '', 'Choco_Broken22', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(256, 'Trozo 23', '', 'concurso', '', 'Choco_Broken23', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(257, 'Trozo 24', '', 'concurso', '', 'Choco_Broken24', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(258, 'Trozo 25', '', 'concurso', '', 'Choco_Broken25', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(259, 'Trozo 26', '', 'concurso', '', 'Choco_Broken26', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(260, 'Trozo 27', '', 'concurso', '', 'Choco_Broken27', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(261, 'Trozo 28', '', 'concurso', '', 'Choco_Broken28', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(262, 'Trozo 29', '', 'concurso', '', 'Choco_Broken29', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(263, 'Trozo 30', '', 'concurso', '', 'Choco_Broken30', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(264, 'Trozo 31', '', 'concurso', '', 'Choco_Broken31', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(265, 'Trozo 32', '', 'concurso', '', 'Choco_Broken32', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(266, 'Trozo 33', '', 'concurso', '', 'Choco_Broken33', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(267, 'Trozo 34', '', 'concurso', '', 'Choco_Broken34', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(268, 'Trozo 35', '', 'concurso', '', 'Choco_Broken35', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(269, 'Trozo 36', '', 'concurso', '', 'Choco_Broken36', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(270, 'Choco_BunnyD', 'Choco_BunnyD', '', '', 'Choco_BunnyD', '15', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(271, 'Choco_BunnyL', 'Choco_BunnyL', '', '', 'Choco_BunnyL', '15', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(272, 'Choco_Canasta', 'Descripción', '', 'Si', 'Choco_Canasta', '15', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(273, 'Conejito bebé', 'Tan tierno que no podrás dejar de acariciarlo', '', '', 'Choco_Conejito', '3', 1, 0, -1, 0, 1000, 0, 0, 'CBE6F9', '72,72,98', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(274, 'Egg tradicional', 'Item requerido: x25 Setas Venenosas \"Busca Setas en La Madriguera\"', '', '', 'Choco_Egg1', '15', 0, 0, -1, 0, 1000, 0, 0, 'FF63DC', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(275, 'Egg tradicional', 'Item requerido: x25 Setas Venenosas \"Busca Setas en La Madriguera\"', '', '', 'Choco_Egg2', '15', 0, 0, -1, 0, 1000, 0, 0, 'C9F6FFAFDFFFB7F8FF', '72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1);
INSERT INTO `objetos` (`id`, `titulo`, `descripcion`, `Especial`, `colores_mal`, `swf`, `categoria`, `visible`, `visible_mod`, `precio_oro`, `oro_descuento`, `precio_plata`, `vip`, `espacio_mapabytes`, `colores_hex`, `colores_rgb`, `parte_1`, `parte_2`, `parte_3`, `parte_4`, `tam_p`, `tam_n`, `espacio_ocupado_n`, `espacio_2_0`, `tam_g`, `something_4`, `something_5`, `something_6`, `arrastrable`, `salas_usables`, `intercambiable`, `tipo_rare`, `rotacion`, `tipo_arrastre`, `Definicion`, `default_data`, `limitado`, `ofertas`, `precio_anterior`, `efecto_id`, `tiempo_pocion`, `img`) VALUES
(276, 'Egg tradicional', 'Item requerido: x25 Setas Venenosas \"Busca Setas en La Madriguera\"', '', '', 'Choco_Egg3', '15', 0, 0, -1, 0, 1000, 0, 0, '9EEBFFFF78BDFCF8FF', '72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(277, 'Egg de Bianca', 'El primer Egg que hice!', '', '', 'Choco_EggBlanco', '15', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(278, 'Gran Trozo 1', 'Con 6 trozos', '', '', 'Choco_EggPart1', '17', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(279, 'Gran Trozo 2', 'Con 6 trozos', '', '', 'Choco_EggPart2', '17', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(280, 'Gran Trozo 3', 'Con 6 trozos', '', '', 'Choco_EggPart3', '17', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(281, 'Gran Trozo 4', 'Con 6 trozos', '', '', 'Choco_EggPart4', '17', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(282, 'Gran Trozo 5', 'Con 6 trozos', '', '', 'Choco_EggPart5', '17', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(283, 'Gran Trozo 6', 'Con 6 trozos', '', '', 'Choco_EggPart6', '17', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(284, 'Conejo Felpa', 'El conejo de felpa de Bianca', '', '', 'Choco_Gothic', '15', 1, 0, -1, 0, 500, 0, 0, '96E5CB', '72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(285, 'Gran Huevo Blanco', 'Item requerido: x25 Setas Venenosas \"Busca Setas en La Madriguera\" ', '', '', 'Choco_GranEgg', '15', 0, 1, -1, -1, 5000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '1,-2,0,-2,1,-2,-1,-1,0,-1,1,-1,2,-1,-1,0,0,0,1,0,2,0,0,1,1,1,2,1', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(286, 'Choco-Guitarra', 'Item requerido: x50 Setas Venenosas \"Busca Setas en La Madriguera\" ', '', '', 'Choco_Guitar', '15', 0, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(287, 'Mini-Egg', '', '', '', 'Choco_MiniEgg1', '15', 1, 0, -1, 0, 250, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(288, 'Mini-Egg', '', '', '', 'Choco_MiniEgg2', '15', 1, 0, -1, 0, 250, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(289, 'Mini-Egg', '', '', '', 'Choco_MiniEgg3', '15', 1, 0, -1, 0, 250, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(290, 'Mini-Egg', '', '', '', 'Choco_MiniEgg4', '15', 1, 0, -1, 0, 250, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(291, 'Mini-Egg', '', '', '', 'Choco_MiniEgg5', '15', 1, 0, -1, 0, 250, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(292, 'Choco-Moneda', '', '', '', 'Choco_Moneda', '17', 0, 0, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(293, 'Choco-Nido', 'Item requerido: x50 Setas Venenosas \"Busca Setas en La Madriguera\"', '', '', 'Choco_Nest', '15', 0, 0, -1, 0, 1000, 0, 0, 'C5FFC9CED4FFFFC3C3', '72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(294, 'Minitrofeo Bronce Choco', '', 'Trofeo', '', 'Choco_Trofeob', '15', 1, 1, 10000, 8000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(295, 'Trofeo Bronze', '', 'Trofeo', '', 'Choco_TrofeobB', '15', 1, 1, 10000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(296, 'Minitrofeo Oro Choco', '', 'Trofeo', '', 'Choco_Trofeog', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(297, 'Trofeo Oro Choco', '', 'Trofeo', '', 'Choco_TrofeogB', '15', 1, 1, 50000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(298, 'Minitrofeo Plata Choco', '', 'Trofeo', '', 'Choco_Trofeos', '15', 1, 1, 25000, 20000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(299, 'Trofeo Plata Choco', '', 'Trofeo', '', 'Choco_TrofeosB', '15', 1, 1, 25000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(301, 'Bombón S.Valentin 4', 'Tan delicioso', '', '', 'chocolateBombon4', '7', 1, 0, -1, 0, 250, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(302, 'Caja de Bombones', 'Díselo con chocolate. Consigue uno de 5 posibles bombones', '', '', 'chocolateBombonBox', '7', 0, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,0,-1,-1,1,0,1,-1,0,1,0', '0,0,1,0,0,1,0,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(303, 'Fondue de Chocolate', 'Seguro que alguna vez has soñado con una fuente de delicioso chocolate líquido.', '', '', 'chocolateFountain', '7', 1, 0, -1, 0, 500, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(304, 'Casco NFL', '', '', '', 'Christmas_American_Helmet', '8', 1, 0, -1, 0, 150, 0, 0, 'FFF5FCCA44E8F7F4FFD450E0', '72,72,100,72,72,91,72,72,100,72,72,88', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(305, 'Bolsa Navidad', '', '', '', 'Christmas_Bag', '8', 1, 0, -1, 0, 500, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(306, 'Pelota Basket', '', '', '', 'Christmas_Basket_Ball', '8', 1, 0, -1, 0, 50, 0, 0, 'ED823A', '72,72,93', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(307, 'Osito Navideño', '', '', '', 'Christmas_Bear', '8', 1, 1, 20000, 16000, -1, 0, 0, 'DBA255FFFFFFEADEEFFF363C', '72,72,86,72,72,100,72,72,94,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(308, 'Coche Juguete', '', '', '', 'Christmas_Buggy_Toy', '8', 1, 0, -1, 0, 200, 0, 0, 'FF273EFFFA50C5E7FF', '72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(309, 'Caramelo Navidad', '', '', '', 'Christmas_Candy01', '8', 1, 0, -1, 0, 300, 0, 0, 'FF2E35FCFFFF', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(311, 'Duende Navideño [NPC]', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', '', '', 'Christmas_ContestHat_1', '6', 0, 1, 50000, 40000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '-1,0,-1,-1,0,-1,1,-1,1,0,1,1,0,1,0,0,-1,1,-2,1,-2,0,-2,-1,-2,-2,-1,-2,0,-2,1,-2,2,-1,2,0,2,1,2,2,1,2', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(312, 'Duende Navideño [NPC]', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', '', '', 'Christmas_ContestHat_2', '6', 0, 1, 50000, 40000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(313, 'Duende Navideño', 'a', '', '', 'Christmas_ContestHat_3', '6', 1, 1, 20000, 16000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,1,0,-1', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(315, 'Donut Congelado', 'Donut Congelado', 'concurso', '', 'Christmas_Doughnut', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(316, 'Avion Juguete', '', '', '', 'Christmas_Fighter', '8', 1, 0, -1, 0, 200, 0, 0, 'FFF532FF4556FF222E63F3FF', '72,72,100,72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(317, 'Regalo de Santa', 'Diferentes juguetes en cada regalo', '', '', 'Christmas_Gift_1', '8', 0, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(318, 'Regalo de Santa', 'Diferentes juguetes en cada regalo', '', '', 'Christmas_Gift_2', '8', 0, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(319, 'Llave Navidad', 'Abre la puerta de tu habitación.', 'npc', '', 'Christmas_Key', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(320, 'Coche Juguete', '', '', '', 'Christmas_Mini', '8', 1, 0, -1, 0, 200, 0, 0, '7BD6FFE7FF66FEF4FFFFF7FA', '72,72,100,72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(321, 'Minitrofeo Bronce Navidad', '', 'Trofeo', '', 'Christmas_MiniTrophy_Bronze', '15', 1, 1, 10000, 8000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(322, 'Minitrofeo Oro Navidad', '', 'Trofeo', '', 'Christmas_MiniTrophy_Gold', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(323, 'Minitrofeo Plata Navidad', '', 'Trofeo', '', 'Christmas_MiniTrophy_Silver', '15', 1, 1, 25000, 20000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(324, 'Avion Juguete', '', '', '', 'Christmas_Plane', '8', 1, 0, -1, 0, 200, 0, 0, '6C53FF515FD1FF697AFFFAFD', '72,72,100,72,72,82,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(325, 'Regalo Violeta', 'Regalo Violeta', 'npc', '', 'Christmas_Present_1', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(326, 'Regalo Naranja', 'Regalo Naranja', 'npc', '', 'Christmas_Present_2', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(327, 'Regalo Rojo', 'Regalo Rojo', 'npc', '', 'Christmas_Present_3', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(328, 'Reno', 'Un bonito reno navideño en tu casa! Que más puedes desear estas fiestas?! Solo disponible en Navidad', '', '', 'Christmas_Reindeer', '1', 1, 0, -1, 0, 1000, 0, 0, 'FFFA50', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,0,1,0,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(329, 'Cohetes Navideños', '', '', '', 'Christmas_Rockets', '8', 1, 0, -1, 0, 500, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(330, 'Pelota Rugby', '', '', '', 'Christmas_Rugby_Ball', '8', 1, 0, -1, 0, 400, 0, 0, 'D38364', '72,72,83', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(331, 'Scalextrix', '', '', '', 'Christmas_Scalextrix', '8', 1, 0, -1, 0, 500, 0, 0, '23262DFFFA50FF343E', '72,72,18,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,0,1,0,1,1', '0,0,-1,0,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(332, 'Pelota Futbol', '', '', '', 'Christmas_Soccer_Ball', '8', 1, 0, -1, 0, 200, 0, 0, 'FEF7FF000000', '72,72,100,72,72,0', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(333, 'Mesa Navideña', 'Incluye todo lo imprescindible para celebrar un día tan especial! Solo disponible en Navidad', '', '', 'Christmas_Table', '8', 1, 0, -1, 0, 500, 0, 0, 'FFD8CDFF6A63FFD7609B7A7E', '72,72,100,72,72,100,72,72,100,72,72,61', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(334, 'Árbol Navideño', 'Santa vendrá el 25 de diciembre y dejará un regalito junto al árbol. No te olvides de abrirlo', '', '', 'Christmas_Tree', '6', 1, 1, 20000, 16000, -1, 0, 0, '9CFF3BFDFF1DFFF927', '72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,0,-1,-1,-1,0,1,1,0,1,1', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(335, 'Arbolito Navidad', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', '', '', 'Christmas_Tree01', '6', 0, 0, -1, 0, 5000, 1, 0, 'FF3A3A74FF4CFFFA505085FF', '72,72,100,72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,1,1,0,0,-1,-1,-1,1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(336, 'Trofeo Bronce Navidad', '', 'Trofeo', '', 'Christmas_Trophy_Bronze', '15', 1, 1, 10000, 8000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(337, 'Trofeo Oro Navidad', '', 'Trofeo', '', 'Christmas_Trophy_Gold', '15', 1, 1, 50000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(338, 'Trofeo Plata Navidad', '', 'Trofeo', '', 'Christmas_Trophy_Silver', '15', 1, 1, 25000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(340, 'Nube Corazón', 'Tu también ves un corazón? Estás colado! Las nubes no hacen eso...', '', '', 'cloudHeart', '7', 1, 0, -1, 0, 400, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(341, 'Coco Bronce', '', 'Trofeo', '', 'cocosBronce', '17', 0, 1, 10000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(342, 'Coco Oro', '', 'Trofeo', '', 'cocosOro', '17', 0, 1, 30000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(343, 'Coco Plata', '', 'Trofeo', '', 'cocosPlata', '17', 0, 1, 20000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(345, 'ColaCao Batimu', 'ColaCao Batimu', '', '', 'ColaCao_batimu', '1', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(346, 'Cámara Colacao', '', '', '', 'ColaCao_Camera', '1', 1, 0, -1, 0, 500, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(347, 'Chocorare', 'Tan delicioso', '', '', 'chocolatBombonRare', '7', 1, 1, 20000, 16000, -1, 1, 0, 'F505E7', '72,72,97', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,0,0,1,1,1,0,-1,1,0,-1,-1', '0,0,0,1,-1,0,0,0,0,1,-1,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(348, 'Bombón S.Valentin 1', 'Tan delicioso', '', '', 'chocolateBombon1', '7', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(349, 'Bombón S.Valentin 2', 'Tan delicioso', '', '', 'chocolateBombon2', '7', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(350, 'Bombón S.Valentin 3', 'Tan delicioso', '', '', 'chocolateBombon3', '7', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(352, 'ColaCao Zapatos', 'ColaCao Zapatos', '', '', 'ColaCao_Zapatos', '1', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(353, 'Trampa para Conejos', '¡Atrapa el conejo!', '', '', 'Conejo_Caja', '15', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(354, 'Conejo Guay', '', '', '', 'Conejo_Chulo', '15', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(355, 'Conejo SuperGuay', '', '', '', 'Conejo_ChuloRare', '15', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(356, 'Conejita', '', '', '', 'Conejo_Conejita', '15', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(357, 'Super Conejita', '', '', '', 'Conejo_ConejitaRare', '15', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(358, 'Conejín', '', '', '', 'Conejo_Conejito', '15', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(359, 'Super Conejín', '', '', '', 'Conejo_ConejitoRare', '15', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(360, 'Conejón', '', '', '', 'Conejo_Gordo', '15', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(361, 'Super Conejón', '', '', '', 'Conejo_GordoRare', '15', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(362, 'Conejo Loco', '', '', '', 'Conejo_Loco', '15', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(363, 'Conejo SuperLoco', '', '', '', 'Conejo_LocoRare', '15', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(364, 'Conejo Feliz', '', '', '', 'Conejo_Normal', '15', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(365, 'Conejo SuperFeliz', '', '', '', 'Conejo_NormalRare', '15', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(366, 'Chocobunny 1', 'conejo1p', 'Trofeo', '', 'conejo1p', '15', 1, 1, 100000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(367, 'Chocobunny 2', 'conejo2p', 'Trofeo', '', 'conejo2p', '15', 1, 1, 50000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(368, 'Chocobunny 3', 'conejo3p', 'Trofeo', '', 'conejo3p', '15', 1, 1, 25000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(370, 'Contador Visitas', '¡Contabiliza las visitas que recibes en tu isla! Si lo mueve', '', '', 'Contador_Visita', '1', 1, 0, -1, 0, 500, 0, 0, '4F64FF', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 24, '', '0', 0, 0, -1, NULL, NULL, 1),
(371, 'BBox hielo', 'Con BBox', '', '', 'cubo', '6', 1, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(372, 'Cupido Artista', '', '', '', 'Cupido_Baby', '7', 1, 1, 20000, 16000, -1, 1, 0, 'FFBDC7', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(373, 'Cupido Artista', '', '', '', 'Cupido_Boy', '7', 1, 1, 50000, 40000, -1, 1, 0, 'FFBDC7', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(374, 'Cupido Artista', '', '', '', 'Cupido_Girl', '7', 1, 1, 50000, 40000, -1, 1, 0, 'FFBDC7', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(375, 'Trofeo SV 2010', '', '', '', 'Cupido_Winner', '7', 1, 1, 20000, 16000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(376, 'Empanadino', '', '', '', 'dino', '3', 1, 0, -1, 0, 2000, 0, 0, 'C9AF79', '72,72,79', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 12, '', '0', 0, 0, -1, NULL, NULL, 1),
(377, 'Rexito', 'dino2', '', '', 'dino2', '3', 1, 0, -1, 0, 2000, 0, 0, '71C7D6', '72,72,84', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 12, '', '0', 0, 0, -1, NULL, NULL, 1),
(378, 'Anky', 'dino3', '', '', 'dino3', '3', 1, 0, -1, 0, 2000, 0, 0, 'EFDBC257A59AD3DDD7', '72,72,94,72,72,65,72,72,87', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 12, '', '0', 0, 0, -1, NULL, NULL, 1),
(379, 'Baby Trice', 'dino4', '', '', 'dino4', '3', 1, 0, -1, 0, 2000, 0, 0, 'D3834827AEDD', '72,72,83,72,72,87', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 12, '', '0', 0, 0, -1, NULL, NULL, 1),
(380, 'Dino Lee', 'dino5', '', '', 'dino5', '3', 1, 1, 50000, 40000, -1, 0, 0, 'F9A8DAAF947C', '72,72,98,72,72,69', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 12, '', '0', 0, 0, -1, NULL, NULL, 1),
(381, 'Sable gato', 'dino6', '', '', 'dino6', '3', 1, 0, -1, 0, 2000, 0, 0, 'F2B84B', '72,72,95', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 12, '', '0', 0, 0, -1, NULL, NULL, 1),
(382, 'Pekedactilo', 'dino7', '', '', 'dino7', '3', 1, 1, 50000, 40000, -1, 0, 0, '6FA873D19F88E0C6A975E524', '72,72,66,72,72,82,72,72,88,72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 4, '', '0', 0, 0, -1, NULL, NULL, 1),
(383, 'Raresaurio', 'El último de su especie.', '', '', 'dino8', '3', 1, 0, -1, 0, 4000, 0, 0, 'D3834827AEDD', '72,72,83,72,72,87', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 12, '', '0', 0, 0, -1, NULL, NULL, 1),
(384, 'Huevosaurio', 'Un huevo. Siete dinosaurios. ¿Cuál te tocará?', '', '', 'dinoegg', '3', 0, 0, -1, 0, 1000, 0, 0, 'FDFFF4D4FF7D', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 11, '', '0', 0, 0, -1, NULL, NULL, 1),
(385, 'Deinonicus', '', '', '', 'dinosaurio1', '3', 1, 1, 50000, 40000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(386, 'Triceratops', '', '', '', 'dinosaurio2', '3', 1, 1, 50000, 40000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(387, 'Mamut', '', '', '', 'dinosaurio3', '3', 1, 1, 50000, 40000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,2,0,3,0,1,1,2,1,2,1,1,-1,2,-1,3,1', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(388, 'Diplodocus', '', '', '', 'dinosaurio4', '3', 1, 1, 50000, 40000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,2,1,3,1,3,2', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(389, 'Guitarra Jonas', 'disney_rock_band2', '', '', 'disney_rock_band2', '300', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,1,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(391, 'Guarida', 'Un cómodo refugio para tu mascota durante las largas noches invernales.', '', '', 'doghouse', '3', 1, 0, -1, 0, 50, 0, 0, 'FEFBCC48BE4D469FE7', '72,72,100,72,72,75,72,72,91', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0,1,1', '0,0,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(392, 'Doll', '', '', '', 'doll', '8', 1, 0, -1, 0, 1500, 0, 0, '9E632CE2517CBAE57C', '72,72,62,72,72,89,72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(393, 'Paloma del amor', 'Si triunfa el amor', '', '', 'dove', '7', 1, 0, -1, 0, 500, 0, 0, 'C6D9EFDD9CCFCC986A', '72,72,94,72,72,87,72,72,80', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-3,-2', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 12, '', '0', 0, 0, -1, NULL, NULL, 1),
(394, 'Dragón', 'No lo dudes: los dragones escupen fuego! Y este no iba a ser una excepción :P', '', '', 'dragon', '3', 1, 0, -1, 0, 500, 0, 0, '1EAA18', '72,72,67', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 4, '', '0', 0, 0, -1, NULL, NULL, 1),
(395, 'Cestita', 'La que lleva Caperucita en Pascuas', '', '', 'Easter_Basket', '15', 1, 0, -1, 0, 250, 0, 0, 'F8FF4363F3FF896141FFCEEC', '72,72,100,72,72,100,72,72,54,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(397, 'Gran Huevo Negro', 'Item requerido: x50 Setas Venenosas \"Busca Setas en La Madriguera\" ', '', '', 'Easter_BigEgg', '15', 0, 1, -1, -1, 5000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0,1,1,-1,-1,-1,0,0,1', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(398, 'Trozo 1', '', 'concurso', '', 'Easter_BigEggPart1', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(399, 'Trozo 2', '', 'concurso', '', 'Easter_BigEggPart2', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(400, 'Trozo 3', '', 'concurso', '', 'Easter_BigEggPart3', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(401, 'Trozo 4', '', 'concurso', '', 'Easter_BigEggPart4', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(402, 'Trozo 5', '', 'concurso', '', 'Easter_BigEggPart5', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(403, 'Trozo 6', '', 'concurso', '', 'Easter_BigEggPart6', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(404, 'Trozo 7', '', 'concurso', '', 'Easter_BigEggPart7', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(405, 'Trozo 8', '', 'concurso', '', 'Easter_BigEggPart8', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(406, 'Trozo 9', '', 'concurso', '', 'Easter_BigEggPart9', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(407, 'Trozo 10', '', 'concurso', '', 'Easter_BigEggPart10', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(408, 'Trozo 11', '', 'concurso', '', 'Easter_BigEggPart11', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(409, 'Trozo 12', '', 'concurso', '', 'Easter_BigEggPart12', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(410, 'Trozo 13', '', 'concurso', '', 'Easter_BigEggPart13', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(411, 'Trozo 14', '', 'concurso', '', 'Easter_BigEggPart14', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(412, 'Trozo 15', '', 'concurso', '', 'Easter_BigEggPart15', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(413, 'Trozo 16', '', 'concurso', '', 'Easter_BigEggPart16', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(414, 'Trozo 17', '', 'concurso', '', 'Easter_BigEggPart17', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(415, 'Trozo 18', '', 'concurso', '', 'Easter_BigEggPart18', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(416, 'Trozo 19', '', 'concurso', '', 'Easter_BigEggPart19', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(417, 'Trozo 20', '', 'concurso', '', 'Easter_BigEggPart20', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(418, 'Trozo 21', '', 'concurso', '', 'Easter_BigEggPart21', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(419, 'Trozo 22', '', 'concurso', '', 'Easter_BigEggPart22', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(420, 'Trozo 23', '', 'concurso', '', 'Easter_BigEggPart23', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(421, 'Trozo 24', '', 'concurso', '', 'Easter_BigEggPart24', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(422, 'Trozo 25', '', 'concurso', '', 'Easter_BigEggPart25', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(423, 'Trozo 26', '', 'concurso', '', 'Easter_BigEggPart26', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(424, 'Trozo 27', '', 'concurso', '', 'Easter_BigEggPart27', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(425, 'Trozo 28', '', 'concurso', '', 'Easter_BigEggPart28', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(426, 'Trozo 29', '', 'concurso', '', 'Easter_BigEggPart29', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(427, 'Trozo 30', '', 'concurso', '', 'Easter_BigEggPart30', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(428, 'Trozo 31', '', 'concurso', '', 'Easter_BigEggPart31', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(429, 'Trozo 32', '', 'concurso', '', 'Easter_BigEggPart32', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(430, 'Trozo 33', '', 'concurso', '', 'Easter_BigEggPart33', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(431, 'Trozo 34', '', 'concurso', '', 'Easter_BigEggPart34', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(432, 'Trozo 35', '', 'concurso', '', 'Easter_BigEggPart35', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(433, 'Trozo 36', '', 'concurso', '', 'Easter_BigEggPart36', '12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(434, 'Gran Trozo 1', 'Con 6 trozos', '', '', 'Easter_BigEggPiece1', '12', 1, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(435, 'Gran Trozo 2', 'Con 6 trozos', '', '', 'Easter_BigEggPiece2', '12', 1, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(436, 'Gran Trozo 3', 'Con 6 trozos', '', '', 'Easter_BigEggPiece3', '12', 1, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(437, 'Gran Trozo 4', 'Con 6 trozos', '', '', 'Easter_BigEggPiece4', '12', 1, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(438, 'Gran Trozo 5', 'Con 6 trozos', '', '', 'Easter_BigEggPiece5', '12', 1, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(439, 'Gran Trozo 6', 'Con 6 trozos', '', '', 'Easter_BigEggPiece6', '12', 1, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(440, 'Conejo rosa', 'No lleva pilas', '', '', 'Easter_Bunny', '15', 1, 0, -1, 0, 1000, 0, 0, 'FF74DBFFF1FBFEC7FF', '72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(441, 'Zanahora gigante', 'Es sencillamente inexplicable', '', '', 'Easter_Carrot', '15', 0, 0, -1, 0, 1000, 0, 0, 'FF9F30', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(444, 'Madriguera', 'Item requerido: x50 Setas Venenosas \"Busca Setas en La Madriguera\" ', '', '', 'easter_house', '15', 0, 1, -1, -1, 5000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,1,-1,1,-1,0,-1,-1,0,-1,1,-1,1,0,1,1,1,2', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 2, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(445, 'Llave de pascuas', '', 'npc', '', 'Easter_Key', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(450, 'Arbol de Pascuas', 'El espíritu de Pascua llenará tu casita.', '', '', 'Easter_Tree', '15', 0, 0, -1, 0, 1000, 0, 0, '27E6FFFFB1FB', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,1,-1,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(451, 'Mesita de pascuas', '', '', '', 'Easter_WoodTable', '15', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(452, 'Coneggo', '', '', '', 'egg_bunny', '15', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(453, 'Disco Egg', 'Música disco para ir calentando motores.', '', '', 'Egg_Disco', '15', 1, 0, -1, 0, 1000, 0, 0, 'FF40BB2F76FF84FF41FFFA50', '72,72,100,72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0,0,-1', '0,-1,0,0,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '', '0', 0, 0, -1, NULL, NULL, 1),
(454, 'Music Egg', '', '', '', 'Egg_Ethnic', '15', 1, 0, -1, 0, 1000, 0, 0, 'FCFFFFC3BEC4EAA124', '72,72,100,72,72,77,72,72,92', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0,0,-1', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '', '0', 0, 0, -1, NULL, NULL, 1),
(455, 'ArtistEgg Verde', '', '', '', 'Egg_FanArt1', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,0,1,-1,1', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(456, 'ArtistEgg Azul', '', '', '', 'Egg_FanArt2', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,0,1,-1,1', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(457, 'ArtistEgg Rosa', '', '', '', 'Egg_FanArt3', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,0,1,-1,1', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(458, 'Gorynych', 'Gorynych', '', '', 'egg_gorynych', '15', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0,0,-1', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(459, 'Music Egg', '¿Sabias que bailar es soñar con los pies?', '', '', 'Egg_HipHop', '15', 1, 0, -1, 0, 1000, 0, 0, '425FFFED9628E8263BEAE8EF', '72,72,100,72,72,93,72,72,91,72,72,94', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0,0,-1', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '', '0', 0, 0, -1, NULL, NULL, 1),
(460, 'Ice Egg', 'Atención: Estos objetos son del año pasado. Si no estuviste', '', '', 'egg_ice', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0,1,0,0,-1', '0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(461, 'Egg Fósil', '', '', '', 'egg_ice1', '15', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(462, 'Egg Fósil', '', '', '', 'egg_ice2', '15', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(463, 'Egg Fósil', '', '', '', 'egg_ice3', '15', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(464, 'Egg Fósil', '', '', '', 'egg_ice4', '15', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(465, 'Egg Fósil', '', '', '', 'egg_ice5', '15', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(466, 'Egg Fosil', '', '', '', 'egg_ice6', '15', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(467, 'Egg Fosil', '', '', '', 'egg_ice7', '15', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(468, 'Egg Fosil', '', '', '', 'egg_ice8', '15', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(469, 'Egg Fosil', '', '', '', 'egg_ice9', '15', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(470, 'Music Egg', 'Sin música la vida sería un tostón.', '', '', 'Egg_Jazz', '15', 1, 0, -1, 0, 1000, 0, 0, 'FFB541', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0,0,-1', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '', '0', 0, 0, -1, NULL, NULL, 1),
(471, 'Long Mu', 'Long Mu', '', '', 'egg_long_mu', '15', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0,0,-1', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(472, 'Eggspejo', '', '', '', 'egg_mirror', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(473, 'Nuwa', 'Nuwa', '', '', 'egg_nuwa', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0,0,-1', '0,0,1,0,0,-1', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(474, 'Orochi', 'Orochi', '', '', 'egg_orochi', '15', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0,0,-1', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(475, 'Eggpyrus', '', '', '', 'egg_plinth', '15', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0,1,0,0,-1', '0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(476, 'Music Egg', 'No hace falta llevar rastas para moverse al ritmo de este Music Egg.', '', '', 'Egg_Reggae', '15', 1, 0, -1, 0, 1000, 0, 0, 'DD2D3760CE4FFFC42F', '72,72,87,72,72,81,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0,0,-1', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '', '0', 0, 0, -1, NULL, NULL, 1);
INSERT INTO `objetos` (`id`, `titulo`, `descripcion`, `Especial`, `colores_mal`, `swf`, `categoria`, `visible`, `visible_mod`, `precio_oro`, `oro_descuento`, `precio_plata`, `vip`, `espacio_mapabytes`, `colores_hex`, `colores_rgb`, `parte_1`, `parte_2`, `parte_3`, `parte_4`, `tam_p`, `tam_n`, `espacio_ocupado_n`, `espacio_2_0`, `tam_g`, `something_4`, `something_5`, `something_6`, `arrastrable`, `salas_usables`, `intercambiable`, `tipo_rare`, `rotacion`, `tipo_arrastre`, `Definicion`, `default_data`, `limitado`, `ofertas`, `precio_anterior`, `efecto_id`, `tiempo_pocion`, `img`) VALUES
(477, 'Rocky Egg', '¡Sacude tu cuerpo!', '', '', 'Egg_Rock2', '15', 1, 0, -1, 0, 1000, 0, 0, '9EA09E757473', '72,72,63,72,72,46', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0,0,-1', '0,-1,0,0,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '', '0', 0, 0, -1, NULL, NULL, 1),
(478, 'Celia Egg', '¿Preparado para bailar?', '', '', 'Egg_Salsa', '15', 1, 0, -1, 0, 1000, 0, 0, '55F3FFFFFF226CD0FF00E50D', '72,72,100,72,72,100,72,72,100,72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0,0,-1', '0,-1,0,0,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '', '0', 0, 0, -1, NULL, NULL, 1),
(479, 'Seiryu', 'Seiryu', '', '', 'egg_seiryu', '15', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0,0,-1', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(480, 'Egg Espacial', 'Conseguirás 2 Eggs Espaciales por este precio', '', '', 'Egg_Teleport', '15', 1, 1, 50000, 40000, -1, 0, 0, 'B8E5FF82FF93FE144E', '72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,-2,1,-2,2,-2,-1,-1,0,-1,1,-1,2,-1,1,0,2,0,1,1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 22, '', '0', 0, 0, -1, NULL, NULL, 1),
(481, 'Egg Espacial', 'Atención: Estos objetos son del año pasado. Si no estuviste', '', '', 'egg_vader', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0', '0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(482, 'Vader Egg', '', '', '', 'egg_vader1', '15', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(483, 'Vader Egg', '', '', '', 'egg_vader2', '15', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(484, 'Vader Egg', '', '', '', 'egg_vader3', '15', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(485, 'Vader Egg', '', '', '', 'egg_vader4', '15', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(486, 'Vader Egg', '', '', '', 'egg_vader5', '15', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(487, 'Vader Egg', '', '', '', 'egg_vader6', '15', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(488, 'Vader Egg', '', '', '', 'egg_vader7', '15', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(489, 'Vader Egg', '', '', '', 'egg_vader8', '15', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(490, 'Huevo Fresco', 'para ver un pollito nacer hay que esperar', '', '', 'EggPet_BaseMalo', '12', 1, 0, -1, 0, 1500, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(491, 'Huevo de corral', 'para ver un pollito nacer hay que esperar', '', '', 'EggPet_BaseNormal', '12', 1, 0, -1, 0, 1500, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(492, 'Huevo de corral', 'para ver un pollito nacer hay que esperar', '', '', 'EggPet_Blue', '12', 1, 0, -1, 0, 1500, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(493, 'Huevo Fresco', 'para ver un pollito nacer hay que esperar', '', '', 'EggPet_EggMaloCian', '12', 1, 0, -1, 0, 1500, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(494, 'Huevo Fresco', 'para ver un pollito nacer hay que esperar', '', '', 'EggPet_EggMaloNegroRare', '12', 1, 0, -1, 0, 1500, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(495, 'Huevo Fresco', 'para ver un pollito nacer hay que esperar', '', '', 'EggPet_EggMaloRosa', '12', 1, 0, -1, 0, 1500, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(496, 'Huevo Fresco', 'para ver un pollito nacer hay que esperar', '', '', 'EggPet_EggMaloVerde', '12', 1, 0, -1, 0, 1500, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(497, 'Pollito Azul', '', '', '', 'EggPet_PetBlue', '3', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(498, 'Pollito tímido', '', '', '', 'EggPet_PetRare', '3', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(499, 'Pollito Azul Oscuro', '', '', '', 'EggPet_PetStrongBlue', '3', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(500, 'Pollito Blanco', '', '', '', 'EggPet_PetWhite', '3', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(501, 'Pollo Azul', '', '', '', 'EggPet_PolloMaloCian', '3', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(502, 'Pollo pirata', '', '', '', 'EggPet_PolloMaloNegroRare', '3', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(503, 'Pollo Rosa', '', '', '', 'EggPet_PolloMaloRosa', '3', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(504, 'Pollo Verde', '', '', '', 'EggPet_PolloMaloVerde', '3', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(505, 'Huevo de Corral', 'para ver un pollito nacer hay que esperar', '', '', 'EggPet_Rare', '12', 1, 0, -1, 0, 1500, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(506, 'Huevo de corral', 'para ver un pollito nacer hay que esperar', '', '', 'EggPet_StrongBlue', '12', 1, 0, -1, 0, 1500, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(507, 'Huevo de corral', 'para ver un pollito nacer hay que esperar', '', '', 'EggPet_White', '12', 1, 0, -1, 0, 1500, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(508, 'Duende Graffitero [NPC]', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', '', '', 'Elves_Fanart_1', '6', 0, 1, 20000, 16000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,-1,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(509, 'Duende Graffitero [NPC]', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', '', '', 'Elves_Fanart_2', '6', 0, 1, 50000, 40000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,-1,-1,0,1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(510, 'Duende Graffitero [NPC]', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', '', '', 'Elves_Fanart_3', '6', 0, 1, 50000, 40000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,-1,-1,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(511, 'Spike', 'Es muy curioso y si lo tocas te puedes pinchar', '', '', 'erizo', '3', 1, 1, 20000, 16000, -1, 0, 0, 'FFD9C5FFE3C7', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 9, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(512, 'K Oliver', 'Mueve tu esqueleto al ritmo de la danza que marca la percusión!', '', '', 'esqueleto1', '4', 1, 0, -1, 0, 1000, 0, 0, '8CA9C346FB2D', '72,72,77,72,72,99', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(513, 'L Armstrong', 'Disfruta del jazz de ultratumba con tus amigos!', '', '', 'esqueleto2', '4', 1, 0, -1, 0, 1000, 0, 0, 'C386A4FEDF07', '72,72,77,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(514, 'B Bolden', 'Convoca a los espíritus de los alrededores con el espeluznante sonido de este didgeridoo...', '', '', 'esqueleto3', '4', 1, 0, -1, 0, 1000, 0, 0, '97C396FE803B', '72,72,77,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,0,1,0,2', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(515, 'Esquimal', '¿Alguien puede decirle que ponga un cebo?', '', '', 'esquimal', '6', 1, 0, -1, 0, 1000, 0, 0, 'E5D2BAF4CCB4CC6641', '72,72,90,72,72,96,72,72,80', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,0', '0,0,-1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(516, 'Cisne de Hielo', 'Instrucciones de uso: mantener por debajo de 0ºC.', '', '', 'estatuaHielo1', '6', 1, 0, -1, 0, 400, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(517, 'Trucha de hielo', 'Una escultura muy cool', '', '', 'estatuaHielo2', '6', 1, 0, -1, 0, 50, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(518, 'Estrella de mar', 'Bellas en la playa... ¡Sorprendentes en el monte!', '', '', 'estrella', '1', 1, 0, -1, 0, 10, 0, 0, '48E243', '72,72,89', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '', '0', -50, 0, -50, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(519, 'Conejo Malvado', 'Come zanahorias', '', '', 'evil_bunny', '15', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,-1,0,0,1,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(520, 'Fábrica de regalos', 'El lugar del que salen los sueños hechos realidad.', '', '', 'fabrica_regalos', '8', 1, 1, 20000, 16000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,1,2,2,1,3,1,4,0,4,-1,4,-2,5,-3,6,-4,6,-5,5,-5,4,-5,3,-5,2,-5,1,-5,0,-5,-1,-4,-1,-3,-1,-3,-2,-2,-3,-1,-3,0,-3,1,-3,1,-2,1,-1,2,0,2,1,0,3,-1,3,-2,3,-2,4,-3,4,-4,5,-4,4,-4,2,-4,3,-3,2,-2,2,-3,3,-1,2,0,2,1,2,-3,0,-4,0,-4,1,-3,5,-2,-1,-2,0,-1,0,1,0,-2,-2,-1,-2,0,-2,-3,1,-2,1,-1,1,0,1,0,-1,-1,-1', '0,0,0,-1,1,-1,2,-1,1,0,2,0,1,1,2,1,1,2,2,2,2,3,2,4,1,4,0,4,1,3,0,3,-1,4,-2,4,-2,5,-3,6,-2,6,-3,5,-3,', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(521, 'Valla', 'Recién pintada.', '', '', 'fence', '1', 1, 0, -1, 0, 10, 0, 0, 'FEFEF747B123', '72,72,100,72,72,70', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0', '0,0,1,0', '0', -12, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(522, 'Valla Amor', 'Romántica y alta para evitar que tu chic@ huya si cambia de opinión', '', '', 'Fence_Love', '7', 1, 0, -1, 0, 150, 0, 0, 'A7B8C184F3FFFFFF35', '72,72,76,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0', '0', -12, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(524, 'Peces', 'Yo creo que ya llevan así un buen rato... esperemos que no se olviden de respirar xD', '', '', 'fishbowl', '7', 1, 0, -1, 0, 25, 0, 0, '82D5EEFE8AB3', '72,72,94,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(525, 'Bandera', 'Menos mal que por aquí siempre hay brisa...', '', '', 'flag_1', '1', 1, 0, -1, 0, 50, 0, 0, 'FE36CFFBFEFEFE9323', '72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,1,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(526, 'Flaming', 'Es siempre el rey de la fiesta', '', '', 'flamingo', '1', 1, 1, 20000, 16000, -1, 1, 0, 'FFB0CEFFA7D9', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(527, 'Florecillas', 'Pequeñas', '', '', 'florecillas', '2', 1, 0, -1, 0, 5, 0, 0, '0387AFFEB010', '72,72,69,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,1,1', '0', -100, 0, -100, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(528, 'Flores Salvajes', 'Igual de bonitas! pero... en la variedad está el gusto no?', '', '', 'florecitas', '2', 1, 0, -1, 0, 10, 0, 0, '01740A7BC625FEF11B', '72,72,46,72,72,78,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '', '0', -100, 0, -100, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(529, '6 margaritas', 'Ya es primavera en BoomBang!!!', '', '', 'flowers', '2', 1, 0, -1, 0, 10, 0, 0, '4FB92BB42C69FEAC3A', '72,72,73,72,72,71,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(530, 'Tres flores', '3 flores por el precio de una: vaya ganga!', '', '', 'flowers_bl', '2', 1, 0, -1, 0, 500, 0, 0, '20B41C7BF1A6E7C2ACB3DCFE', '72,72,71,72,72,95,72,72,91,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(531, 'Pelota', 'Football Mundial', '', '', 'Football_Mundial', '8', 1, 1, 20000, 16000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(532, 'Foquita', 'De mayor quiere ser la estrella de un Zoo. ¡lo conseguirá!', '', '', 'foquita', '6', 1, 0, -1, 0, 1000, 0, 0, '7CABEF7F80FF', '72,72,94,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(533, 'Mama Foca', 'Está a dieta y los resultados son evidentes...¡un aplauso por ella!', '', '', 'foquita2', '6', 1, 0, -1, 0, 1000, 0, 0, '72C4FF', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(534, 'Diplodocus', 'Huesos prehistóricos de una criatura gigantesca...', '', '', 'fosiles', '1', 1, 1, 50000, 40000, -1, 0, 0, 'FEFECE', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,0,-2,0,1,0', '0,0,1,0,-1,0,-2,0,1,1', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(535, 'fragancia1', 'Descripción', '', 'Si', 'fragancia1', '7', 1, 0, -1, 0, 250, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(536, 'fragancia2', 'Descripción', '', 'Si', 'fragancia2', '7', 1, 0, -1, 0, 250, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(537, 'fragancia3', 'Descripción', '', 'Si', 'fragancia3', '7', 1, 0, -1, 0, 250, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(538, 'fragancia4', 'Descripción', '', 'Si', 'fragancia4', '7', 1, 0, -1, 0, 250, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(539, 'fragancia5', 'Descripción', '', 'Si', 'fragancia5', '7', 1, 0, -1, 0, 250, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(540, 'Franky', '', '', '', 'Franky', '4', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,1,-1,0,-1,1,1,-1,-1', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(541, 'Franky_Bolt', '', 'concurso', '', 'Franky_Bolt', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(542, 'Cerebro', '', 'concurso', '', 'Franky_Brain', '17³12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(543, 'Pie Derecho', '', 'concurso', '', 'Franky_Foot', '17³12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(544, 'Pie Izquierdo', '', 'concurso', '', 'Franky_Foot_1', '17³12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(545, 'Mano Derecha', '', 'concurso', '', 'Franky_Hand', '17³12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(546, 'Mano Izquierda', '', 'concurso', '', 'Franky_Hand_1', '17³12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(547, 'Corazón', '', 'concurso', '', 'Franky_Heart', '17³12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(548, 'Sapo', 'Adivina cuantas moscas puede engullir este sapo sin empacharse!??', '', '', 'froggy', '3', 1, 0, -1, 0, 400, 0, 0, '27AC26', '72,72,68', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 7, '', '0', 0, 0, -1, NULL, NULL, 0),
(549, 'Gárgola', 'Terrorífica...  de verdad!', '', '', 'gargola', '4', 1, 0, -1, 0, 50, 0, 0, 'A7737E31FE48', '72,72,66,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0,-1,1,1,0,-1,0', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(550, 'Gato', 'Me pareció ver un lindo gatito', '', '', 'gato', '3', 1, 0, -1, 0, 3000, 0, 0, 'EC600034B11A', '72,72,93,72,72,70', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 6, '', '0', 0, 0, -1, NULL, NULL, 0),
(551, 'Altar Nupcial', 'Porque un momento tan especial merece un lugar como éste!', '', '', 'Gazebo_Love', '7', 1, 0, -1, 0, 4000, 0, 0, 'E8FFFFBAD0D6C6FF8FFF8CAB', '72,72,100,72,72,84,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,3,0,4,1,4,2,1,-1,2,-1', '-3,0,-3,4,-2,-1,-2,0,-2,2,-2,3,-1,-1,0,-1,0,0,0,2,0,3,0,4,1,-1,1,0,1,1,1,2,2,0,2,1', '0', 19, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(552, 'Pinky', 'Así se quedó tras ver su imagen en un espejo!', '', '', 'ghost1', '4', 1, 0, -1, 0, 1000, 0, 0, '2327EE2DFE32', '72,72,94,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(553, 'Inky', 'Incapaz de pasar desapercibido', '', '', 'ghost2', '4', 1, 0, -1, 0, 1000, 0, 0, 'FE20A834C1FE', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(554, 'Clyde', 'Este tímido fantasma es incapaz de asustar a una mosca', '', '', 'ghost3', '4', 1, 0, -1, 0, 1000, 0, 0, '1DD7DCFE64CA', '72,72,87,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(555, 'Blinky', 'Este simpático fantasma puede ser terrible si se lo propone', '', '', 'ghost4', '4', 1, 0, -1, 0, 1000, 0, 0, 'FEFAFD', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(556, 'Rubi Gigante', '1 en un millón', '', '', 'Giant_Ruby', '8', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,-1,0,0,1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(557, 'Huevo Oro', 'Huevo de pascua', 'Trofeo', '', 'gigantegg1_1', '15', 1, 1, 200000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(558, 'Huevo Plata', 'Huevo de pascua', 'Trofeo', '', 'gigantegg2', '15', 1, 1, 100000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(559, 'Huevo Bronce', 'Huevo de pascua', 'Trofeo', '', 'gigantegg3', '15', 1, 1, 50000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(560, 'Huevo Pascua', 'Huevos de pascua', 'Trofeo', '', 'gigantegg4', '15', 1, 1, 25000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(561, 'Jengibre Abominable [NPC]', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', '', '', 'gingerbread_large', '6', 0, 1, 50000, 40000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(562, 'Jengibre Simpático [NPC]', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', '', '', 'gingerbread_med', '6', 0, 1, 20000, 16000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(563, 'Mini Jengibrín [NPC]', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', '', '', 'gingerbread_small', '6', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(564, 'Gizur [NPC]', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', '', '', 'gnomo1', '6', 0, 0, -1, 0, 5000, 1, 0, 'F4FFD2FFF6BCFFF792', '72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(565, 'Harald  [NPC]', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', '', '', 'gnomo2', '6', 0, 0, -1, 0, 5000, 1, 0, 'FF7A64A0FF1B79FF2D', '72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(566, 'Hakon [NPC]', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', '', '', 'gnomo3', '6', 0, 0, -1, 0, 5000, 1, 0, 'FFBED272C0FF52AEFF', '72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(567, 'Erik [NPC]', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', '', '', 'gnomo4', '6', 0, 0, -1, 0, 1000, 0, 0, 'F9F5EFE7E7FF', '72,72,98,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(568, 'Grim [NPC]', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', '', '', 'gnomo5', '6', 0, 0, -1, 0, 1000, 0, 0, 'F9D99EF0FFADFF7868', '72,72,98,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(569, 'Lurge', '', '', '', 'greenAlien', '9', 1, 0, -1, 0, 5000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(570, 'Lurge Senior', '', '', '', 'greenAlienRare', '9', 1, 1, 20000, 16000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(571, 'grefuchapa', 'Descripción', '', '', 'grefuchapa', '300', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(572, 'Grefusa_Abril', 'Descripción', '', '', 'Grefusa_Abril', '300', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(573, 'grefusa_ballooon', 'Descripción', '', '', 'grefusa_ballooon', '300', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(574, 'Bocazas', 'Halloween 2010', '', '', 'Halloween_2010_Trophie_1', '4', 1, 1, 100000, 80000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,1,1,0,-1,-1,-1,-1,-2,-2,-2,-1,0,-1,1,0,1,-2,-1', '0', 0, 0, 0, '1', '1³0', 1, 2, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(575, 'Primus', 'Halloween 2010', '', '', 'Halloween_2010_Trophie_2', '4', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '-1,1,0,1,1,1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(576, 'Junior', 'Halloween 2010', '', '', 'Halloween_2010_Trophie_3', '4', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,-1,1,1', '0,0,0,-1,1,0,1,1,2,1,2,2,-1,-1', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(577, 'Crastin', 'Halloween 2010', '', '', 'Halloween_2010_Trophie_All', '4', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(578, 'Llave Halloween', 'Abre la puerta de tu habitación!', 'npc', '', 'Halloween_Key', '17', 1, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(579, 'Llave Rota', '', 'npc', '', 'Halloween_Key_Part01', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(580, 'Llave Rota', '', 'npc', '', 'Halloween_Key_Part02', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(584, 'Hamaca', 'Zz zzZzZz Zzz', '', '', 'hamack', '1', 1, 1, 20000, 16000, -1, 0, 0, 'BE8436FE3B59E4D0375AC603', '72,72,75,72,72,100,72,72,90,72,72,78', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,1,0,1,1,0,0,-1', '0,0,1,1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(585, 'Helicoptero', '', '', '', 'helicoptero', '15', 1, 1, 50000, 40000, -1, 0, 0, 'FF923FA7F3FFFFDB9C', '72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 4, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(586, 'Conejito escondido', 'Item requerido: x50 Setas Venenosas \"Busca Setas en La Madriguera\" ', '', '', 'hiddenBunny', '15', 0, 1, 20000, 16000, -1, 0, 0, 'FFD392FFC255FFABE4', '72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 5, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(588, 'Setas', 'Ni se te ocurra probarlas! A menos que quieras ver un elefante volando', '', '', 'hongos', '2', 1, 0, -1, 0, 20, 0, 0, '28ADC1DFB00E04BE18', '72,72,76,72,72,88,72,72,75', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(589, 'Huevo Hop', '', '', '', 'Hop_Egg', '300', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(590, 'Hormiguero', '97.219.019.842 hormigas negras habitan aquí dentro', '', '', 'hormigas', '2', 1, 0, -1, 0, 50, 0, 0, 'AC6E15D50D07', '72,72,68,72,72,84', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(591, 'Eggdissey', 'huevop_bebe', '', '', 'huevop_bebe', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0,1,0,0,-1', '0,0,0,-1,1,0,1,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(592, 'Goldenegg', 'huevop_cinta', '', '', 'huevop_cinta', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0,1,0,0,-1', '0,0,0,-1,1,0,1,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(593, 'Eggzilla', 'huevop_eye', '', '', 'huevop_eye', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0,1,0,0,-1', '0,0,0,-1,1,0,1,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(594, 'Eggtopus', 'huevop_tentacle', '', '', 'huevop_tentacle', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0,1,0,0,-1', '0,0,0,-1,1,0,1,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(596, 'Ice Egg', 'Vuelven los Egg Fosil: esta vez con nuevos animales en el interior!', '', '', 'IceEggEmpty', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0,0,-1', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(597, 'Egg Fósil', '', '', '', 'IceEggFish', '15', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(598, 'Egg Fósil', '', '', '', 'IceEggSkunk', '15', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(599, 'Egg Fósil', '', '', '', 'IceEggSloth', '15', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(600, 'Egg Fósil', '', '', '', 'IceEggSnail', '15', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(601, 'Egg Fósil', '', '', '', 'IceEggSquirrel', '15', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(602, 'Igloo', 'Venia con piscina', '', '', 'igloo', '6', 1, 0, -1, 0, 10000, 0, 0, 'D0E7FF', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,0,1,1,2,-1,1,-2,0,-2,-1,-2,-2,-1,-3,0,-3,1,-2,2,2,3,1,2,0,3,0,2,-1,1,0,0,-1,1,-1,0,-2,-1,-2,-1,-1,-1,0,1,1,2,1,3,-1,2,-2,1,-3', '0,0,1,0,2,0,-1,-1,0,-1,1,-1,2,-1,-2,-2,-1,-2,0,-2,1,-2,-2,-3,-1,-3,0,-3,-2,-4,-1,-4', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 2, '', '1', 0, 0, -1, NULL, NULL, 1),
(603, 'Tienda India', 'Si te gusta por fuera espera a ver como es por dentro ;D', '', '', 'indian_002', '5', 1, 0, -1, 0, 2000, 0, 0, 'DCC6894E7277B1432E', '72,72,87,72,72,47,72,72,70', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,-1,1,1,1,0,0,-1,-1,-2,2,1', '0,0,1,1,-1,-1,-1,-2,0,-1,1,0,2,1,0,-2,1,-1,2,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 2, '', '0', 0, 0, -1, NULL, NULL, 1),
(604, 'Tambor paz', 'Tallado a mano por la tribu de los sin-miedo', '', '', 'indian_drum1', '5', 1, 0, -1, 0, 100, 0, 0, '76B63DDC30A6E2D2C6', '72,72,72,72,72,87,72,72,89', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(605, 'Tambor caza', '', '', '', 'indian_drum2', '5', 1, 1, 20000, 16000, -1, 0, 0, 'E42A214BA260C17E4F', '72,72,90,72,72,64,72,72,76', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(606, 'Tambor lluvia', 'Tallado a mano por la tribu de los pies negros', '', '', 'indian_drum3', '5', 1, 0, -1, 0, 30, 0, 0, '50C8B8E9DFD9', '72,72,79,72,72,92', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(607, 'Tambor guerra', 'Tallado a mano por la tribu de los 6 dedos', '', '', 'indian_drum4', '5', 1, 0, -1, 0, 30, 0, 0, 'DA4F9BF8EEE7', '72,72,86,72,72,98', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(608, 'Sombrero', 'Hazte con uno de estos y prepárate una épica historia para explicar como escapastes con vida', '', '', 'indian_hat', '5', 1, 0, -1, 0, 100, 0, 0, '906750FEF7F7FE3962', '72,72,57,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(609, 'Arte tribal', 'Danza salvajemente a su alrededor tras vencer al enemigo', '', '', 'indian_shrine', '5', 1, 0, -1, 0, 500, 0, 0, 'FEC9315B7FD0DFB8546EBFD2', '72,72,100,72,72,82,72,72,88,72,72,83', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,-1,1,1,0,-1,1,0', '0,0,-1,0,1,0,0,1,1,1,0,-1,-1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(610, 'Diana', 'Atención: esta diana no incluye arco!', '', '', 'indian_target', '5', 1, 0, -1, 0, 25, 0, 0, 'BE6E5F3E44DCDA0A05E5E92C', '72,72,75,72,72,87,72,72,86,72,72,92', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(611, 'Tienda-Fuego', 'Hecho a mano con piel de bisonte', '', '', 'indian_tent1', '5', 1, 0, -1, 0, 2000, 0, 0, '5493D7', '72,72,85', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,-1,1,1,1,0,0,-1,-1,-2,2,1,2,0,1,-1,0,-2', '0,0,1,0,2,0,1,1,2,1,-1,-1,0,-1,1,-1,-1,-2,0,-2', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 2, '', '0', 0, 0, -1, NULL, NULL, 1),
(612, 'Tienda-Tribal', 'Hecho a mano con piel de oso', '', '', 'indian_tent2', '5', 1, 0, -1, 0, 2000, 0, 0, 'FE9C5EFEF929731FB4FE22A6', '72,72,100,72,72,100,72,72,71,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,-1,1,1,0,-1,1,0,2,1,-1,-2,0,-2,1,-1,2,0', '0,0,1,0,2,0,1,1,2,1,-1,-1,0,-1,1,-1,-1,-2,0,-2', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 2, '', '0', 0, 0, -1, NULL, NULL, 1),
(613, 'Tienda-Voodoo', 'Hecho a mano con piel de lobo', '', '', 'indian_tent3', '5', 1, 0, -1, 0, 2000, 0, 0, 'C82D9154E4FB', '72,72,79,72,72,99', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,-1,1,1,1,0,0,-1,2,1,-1,-2,0,-2,1,-1,2,0', '0,0,1,0,2,0,1,1,2,1,-1,-1,0,-1,1,-1,-1,-2,0,-2', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 2, '', '0', 0, 0, -1, NULL, NULL, 1),
(614, 'Tomahawk', 'Ofrenda del aguerrido Toro Sentado a los guerreros más audaces', '', '', 'indian_tomahawk', '5', 1, 0, -1, 0, 200, 0, 0, 'EC8063DC4B65E2DFD5', '72,72,93,72,72,87,72,72,89', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(615, 'Totem Tierra', '', '', '', 'indian_totem1', '5', 1, 1, 50000, 40000, -1, 1, 0, '8AAEFEFE55A9FE8D48', '72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(616, 'Totem Fuego', '', '', '', 'indian_totem2', '5', 1, 1, 50000, 40000, -1, 1, 0, 'E2BA9E35E9E6DC3C85498DE2', '72,72,89,72,72,92,72,72,87,72,72,89', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(617, 'Totem Aire', '', '', '', 'indian_totem3', '5', 1, 1, 20000, 16000, -1, 1, 0, 'C87373399594DF936DE4491F', '72,72,79,72,72,59,72,72,88,72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0', '0,0,0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(619, 'Ithoriana', 'Vino a visitar a su pareja para probar los bizcochos y chocolates de los que tanto le hablaba...', '', '', 'ithoriana', '9', 1, 0, -1, 0, 1000, 0, 0, 'FFBAD4F7FFC7FFB2EDFFC8C8', '72,72,100,72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '', '0', 0, 0, -1, NULL, NULL, 1),
(620, 'Jacuzzi Corazón', 'Nosotros ponemos el agua. Tu las burbujas.', '', '', 'jacuzzi', '7', 1, 0, -1, 0, 2000, 0, 0, '90C6FFD3D6CB', '72,72,100,72,72,84', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0,-1,-1,0,-2,2,0,1,1,0,1,-1,1,-1,0,0,-1,1,-1', '0,0,-1,0,-1,1,0,1,-2,0,-2,1,-2,2,-1,2,0,2', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(628, 'Liana Bronce', '', 'Trofeo', '', 'lianaBronce', '17', 0, 1, 10000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(629, 'Liana Oro', '', 'Trofeo', '', 'lianaOro', '17', 0, 1, 30000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(630, 'Liana Plata', '', 'Trofeo', '', 'lianaPlata', '17', 0, 1, 20000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 1),
(631, 'Llave de Huesos', 'Abre la puerta de tu habitación.', 'npc', '', 'Llave_Huesos', '17', 1, 1, -1, 0, 500, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(632, 'Music Egg', 'Algunos lo llaman ruido. Nosotros pensamos que es arte.', '', '', 'Egg_Rock', '15', 1, 0, -1, 0, 1000, 0, 0, '8C8487CE1314FFBC33', '72,72,55,72,72,81,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0,0,-1', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '', '0', 0, 0, -1, NULL, NULL, 1),
(633, 'Love tree', 'Este árbol milenario ha visto florecer incontables historias de amor bajo sus hojas... y la tuya?', '', '', 'lovetree', '2', 1, 0, -1, 0, 1000, 0, 0, '8460484E7C0CB925237F4E36', '72,72,52,72,72,49,72,72,73,72,72,50', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,1', '0,0,1,1,-1,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(634, 'Hada', 'Libera un hada y consigue su amistad!', '', '', 'Magic_Botella', '14', 0, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(635, 'Escoba Mágica', 'Transporte mágico y ecológico', '', '', 'Magic_Escoba', '14', 1, 0, -1, 0, 500, 0, 0, 'FFE4A7FFF1FBD3B494', '72,72,100,72,72,100,72,72,83', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,1', '0,0,0,1,-1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(636, 'Hada Bosque', '', '', '', 'Magic_Hada1', '14', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(637, 'Hada Agua', '', '', '', 'Magic_Hada2', '14', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(638, 'Hada Traviesa', '', '', '', 'Magic_Hada3', '14', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(639, 'Hada Presumida', '', '', '', 'Magic_Hada4', '14', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(640, 'Hada Madrina', '', '', '', 'Magic_Hada5', '14', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(641, 'Hada Malhumorada', '', '', '', 'Magic_Hada6', '14', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(642, 'Hada Ventisca', '', '', '', 'Magic_Hada7', '14', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(643, 'Hada Real', '', '', '', 'Magic_Hada8', '14', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(644, 'Hada Princesa', '', '', '', 'Magic_Hada9', '14', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(645, 'Hada Oscura', '', '', '', 'Magic_Hada10', '14', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(646, 'Portal Mágico', 'Puerta de entrada a mundos mágicos y misteriosos.', '', '', 'Magic_PGargoyle', '14', 1, 1, 25000, 16000, -1, 0, 0, 'FF3235FF6F6FDEF2E6', '72,72,100,72,72,100,72,72,95', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0,-1,-1,0,-1,1,1', '0,0,0,-1,1,0,1,1,-1,1,-1,-1,-1,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 18, '', '0', 0, 0, -1, NULL, NULL, 0),
(647, 'Magic_PHorns', 'Descripción', '', 'Si', 'Magic_PHorns', '14', 1, 0, -1, 0, 5000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(648, 'Pincel Mágico', '', '', '', 'Magic_Pincel', '14', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,1,-1,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(649, 'Super Pincel Mágico', '', '', '', 'Magic_PincelC', '14', 1, 0, -1, 0, 5000, 1, 0, 'A9E5D6F2E4EEF7C1B7EF28BA', '72,72,90,72,72,95,72,72,97,72,72,94', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,1,-1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(650, 'Magic_PMinotaur', 'Descripción', '', 'Si', 'Magic_PMinotaur', '14', 1, 0, -1, 0, 5000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(651, 'Magic_PPyramid', 'Descripción', '', 'Si', 'Magic_PPyramid', '14', 1, 0, -1, 0, 5000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(652, 'Portal Mágico', 'Puerta de entrada a mundos mágicos y misteriosos.', '', '', 'Magic_PStone', '14', 1, 1, 10000, 16000, -1, 0, 0, 'B7F8FFFFE2D1E5E2D8F1FFB3', '72,72,100,72,72,100,72,72,90,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,2,0,2,-1,2,-2,0,-1,0,0,1,-1,1,1,1,1,0', '0,0,0,1,0,-1,1,0,1,1,-1,1,-1,-1,-2,-1,-1,0,-2,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 18, '', '0', 0, 0, -1, NULL, NULL, 1),
(653, 'Portal Mágico', 'Puerta de entrada a mundos mágicos y misteriosos', '', '', 'Magic_PWell', '14', 1, 1, 35000, 16000, -1, 1, 0, 'C7FFC9E8E1D0D8BFA4DADBD8', '72,72,100,72,72,91,72,72,85,72,72,86', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,-1,0,1,0,2,0,-1,0,-2,1,0,1,-1,1,1,1,2,-1,-2,-1,1,-1,2,-2,-2,-2,-1,-2,-2,-1,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 18, '', '0', 0, 0, -1, NULL, NULL, 0),
(654, 'Torre Mágica', 'De esta torre se sabe quién entra', '', '', 'Magic_Tower', '14', 1, 0, -1, 0, 5000, 0, 0, 'EDD0D0E0E5D6FFB7BDBBC7CE', '72,72,93,72,72,90,72,72,100,72,72,81', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,1,0,1,1,1,1,0,-1,0,0,-1,-1,-1,1,-1', '0,0,0,1,0,-1,0,-2,1,0,1,1,1,-1,1,-2,2,-1,-1,1,-1,-1,-1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 2, '', '0', 0, 0, -1, NULL, NULL, 0),
(655, 'Varita Rota', 'Son muchas las varitas que se rompen en el camino a gran mag@.', '', '', 'Magic_Wand', '14', 1, 0, -1, 0, 600, 0, 0, 'A8D8FF82E1F2B7916A', '72,72,100,72,72,95,72,72,72', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(656, 'Sombrero de Bruja', 'Modelo año 729', '', '', 'Magic_WitchHat', '14', 1, 0, -1, 0, 400, 0, 0, 'BBB9BC', '72,72,74', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(657, 'Sombrero de Mago', 'Imprescindible para pronunciar hechizos', '', '', 'Magic_WizardHat', '14', 1, 0, -1, 0, 400, 0, 0, '84AFF2FFB718', '72,72,95,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(658, 'Mano Zombie', 'En Halloween los no muertos se levantan una vez más para unirse a los vivos', '', '', 'mano', '4', 1, 0, -1, 0, 500, 0, 0, 'ACEEABF0EFFE', '72,72,94,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 5, '', '0', 0, 0, -1, NULL, NULL, 0),
(659, 'Mano Necrófago', 'En Halloween los no muertos se levantan una vez más para unirse a los vivos', '', '', 'manocam', '4', 1, 0, -1, 0, 500, 0, 0, 'FEF4AFA29DEEF0EFFE', '72,72,100,72,72,94,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 5, '', '0', 0, 0, -1, NULL, NULL, 0),
(660, 'Mapa', '', '', '', 'mapa', '8', 1, 0, -1, 0, 1500, 0, 0, 'F2DC35', '72,72,95', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 12, '', '0', 0, 0, -1, NULL, NULL, 0);
INSERT INTO `objetos` (`id`, `titulo`, `descripcion`, `Especial`, `colores_mal`, `swf`, `categoria`, `visible`, `visible_mod`, `precio_oro`, `oro_descuento`, `precio_plata`, `vip`, `espacio_mapabytes`, `colores_hex`, `colores_rgb`, `parte_1`, `parte_2`, `parte_3`, `parte_4`, `tam_p`, `tam_n`, `espacio_ocupado_n`, `espacio_2_0`, `tam_g`, `something_4`, `something_5`, `something_6`, `arrastrable`, `salas_usables`, `intercambiable`, `tipo_rare`, `rotacion`, `tipo_arrastre`, `Definicion`, `default_data`, `limitado`, `ofertas`, `precio_anterior`, `efecto_id`, `tiempo_pocion`, `img`) VALUES
(661, 'Margarita', 'Me quiere', '', '', 'margarita', '1', 1, 0, -1, 0, 10, 0, 0, '2E930904C0CBFE9F04', '72,72,58,72,72,80,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(662, 'Mariposa', 'Es preciosa! Cualquiera diría que hace tan solo unos segundos era un gusano :o', '', '', 'mariposa', '2', 1, 0, -1, 0, 5, 0, 0, 'FEF70F', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 8, '', '0', 0, 0, -1, NULL, NULL, 0),
(663, 'max_lion_belt', 'Descripción', '', '', 'max_lion_belt', '300', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(664, 'Diamante', 'Un souvenir de recuerdo', '', '', 'Medium_Diamond', '8', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(667, 'Meteorito Roto 1', '', '', '', 'meteor_fragment_1', '4', 1, 0, -1, 0, 1000, 0, 0, 'CDDCE5', '72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(668, 'Meteorito Roto 2', '', '', '', 'meteor_fragment_2', '4', 1, 0, -1, 0, 1000, 0, 0, 'DBF7FC', '72,72,99', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(669, 'Meteorito Roto 3', '', '', '', 'meteor_fragment_3', '4', 1, 0, -1, 0, 1000, 0, 0, 'FFEAD2', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(670, 'Meteorito Roto 4', '', '', '', 'meteor_fragment_4', '4', 1, 0, -1, 0, 1000, 0, 0, 'FFAAC7', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(671, 'Araña Gelatinosa', '', '', '', 'Miedo_Arana', '4', 0, 1, 50000, 40000, -1, 0, 0, 'FFF0D9FF83BBFFF0F7FEF4FF', '72,72,100,72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,-1,-1,1,0,1,1', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(672, 'Bastón de Lizzy', 'Incluye a Luigi: Murciélago Espía', '', '', 'Miedo_BatCane', '4', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(673, 'Bolsa de Golosinas', 'Abre tu bolsa de caramelos: contiene golosinas terroríficas de Halloween (hasta 5 diferentes)', '', '', 'Miedo_Bolsa', '4', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(674, 'Ataúd Boomer', 'Exclusivamente para Vampiros!', '', '', 'Miedo_Boom', '4', 0, 0, -1, 0, 10000, 0, 0, 'D6A3ABE53956', '72,72,84,72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,-1,0,-1,1,-1,2,-1,1,0,2,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(675, 'Ataúd Bruja', 'Exclusivamente para Vampiros!', '', '', 'Miedo_Bruja', '4', 0, 0, -1, 0, 10000, 0, 0, 'D6A3ABE53956', '72,72,84,72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,-1,0,-1,1,-1,2,-1,1,0,2,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(676, 'Piruleta infernal', '', '', '', 'Miedo_Candy', '4', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(677, 'Miedo_Candy2', 'Descripción', '', '', 'Miedo_Candy2', '4', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(678, 'Miedo_Candy3', 'Descripción', '', '', 'Miedo_Candy3', '4', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(679, 'Nube Infernal', '', '', '', 'Miedo_CandyF', '4', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(680, 'Bastón de Mischi', 'Incluye esa criatura', '', '', 'Miedo_CandyMonster', '4', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(681, 'Bastón del muerto', '', '', '', 'Miedo_Cane', '4', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(682, 'Ataúd DJ', 'Exclusivamente para Vampiros!', '', '', 'Miedo_Cascos', '4', 0, 0, -1, 0, 10000, 0, 0, 'D6A3ABE53956', '72,72,84,72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,-1,0,-1,1,-1,2,-1,1,0,2,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(683, 'Gusano tóxico', 'Relleno de baba.. tóxica', '', '', 'Miedo_Catap', '4', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(684, 'Gusano muy Tóxico', 'Contiene ración DOBLE de baba tóxica', '', '', 'Miedo_Catapa', '4', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(685, 'Bumbo el tragón', 'Compártelo', '', '', 'Miedo_Catapb', '4', 1, 0, -1, 0, 6000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,-1,1,1,1,0,0,-1', '0,0,1,0,1,1,0,-1,-1,-1,0,1,1,2,-2,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(686, 'Chicle Movedizo', 'Pegajoso: Yuks!', '', '', 'Miedo_Chewing', '4', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', -500, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(687, 'Caramelo dentudo', 'Podrás saborearlo eternamente', '', '', 'Miedo_ChicleA', '4', 1, 0, -1, 0, 500, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(688, 'Caramelo fantasma', 'Podrás saborearlo eternamente', '', '', 'Miedo_ChicleB', '4', 1, 0, -1, 0, 400, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(689, 'Caramelo sospechoso', 'Podrás saborearlo eternamente', '', '', 'Miedo_ChicleC', '4', 1, 0, -1, 0, 400, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(690, 'Ataúd Cholo', 'Exclusivamente para Vampiros!', '', '', 'Miedo_Cholo', '4', 1, 0, -1, 0, 10000, 0, 0, 'D6A3ABE53956', '72,72,84,72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,-1,0,-1,1,-1,2,-1,1,0,2,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(691, 'Estatua Barón [NPC]', 'Ítem requerido: x50 Hueso Esqueleto\" Busca Hueso Esqueleto en área \'Cementerio\'\"', 'Trofeo', '', 'Miedo_CtoAjos', '4', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1,1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(692, 'Mausoleo [NPC]', 'Ítem requerido: x50 Dentadura Zombie\" Busca Dentadura Zombie en área \'Cementerio\'\"', 'Trofeo', '', 'Miedo_DosAjos', '4', 0, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,0,-1,0,-2,0,-3,0,-4,0,-5,-1,-5,-1,-4,-1,-3,1,0,2,0,3,0,4,0,5,1,6,1,4,1,3,1,2,1,1,-4,2,-4,4,-4,5,-4,5,-5,4,-5,5,-3,5,-2,5,-1,5,0,3,-1,1,-2,1,-3,2,-3,3,-3,4,-2,4,-1,2,-2,1,-1,2,-1', '0,0,0,3,1,3,2,3,3,3,4,3,-2,2,-1,2,0,2,1,2,2,2,3,2,4,2,-2,1,-1,1,0,1,1,1,2,1,3,1,4,1,-2,0,-1,0,1,0,2,', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(693, 'Flores Nocturnas', 'Duermen de día y cantan de noche; eso si, no beben agua..', '', '', 'Miedo_EFlower', '4', 1, 0, -1, 0, 100, 0, 0, '4A937264DB8D000000', '72,72,58,72,72,86,72,72,0', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '', '0', -500, -500, -500, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(694, 'Ataúd Nerd', 'Exclusivamente para Vampiros!', '', '', 'Miedo_Empo', '4', 0, 0, -1, 0, 10000, 0, 0, 'D6A3ABE53956', '72,72,84,72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,-1,0,-1,1,-1,2,-1,1,0,2,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(695, 'Espantapájaros', 'Espanta a los pájaros y a las visitas no deseadas!', '', '', 'Miedo_Espantapajaros', '4', 1, 0, -1, 0, 100, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(696, 'Retina de Boomdor', 'Chupachups XXL', '', '', 'Miedo_EyeCandy', '4', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(697, 'Miedo_EyeL', 'Descripción', '', '', 'Miedo_EyeL', '4', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(698, 'Retina acida', 'Chupachups XXL', '', '', 'Miedo_EyeLolly', '4', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(699, 'Valla Oxidada', 'La valla perfecta para crear un ambiente tenebroso en tu isla', '', '', 'Miedo_Fence1', '4', 1, 0, -1, 0, 200, 0, 0, 'C3D8E2', '72,72,89', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0,2,0', '0,0,1,0', '0', -12, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(700, 'Valla Oxidada', 'La valla perfecta para crear un ambiente tenebroso en tu isla', '', '', 'Miedo_Fence2', '4', 1, 0, -1, 0, 100, 0, 0, 'F7FBFFC3D8E2EFD0B2', '72,72,100,72,72,89,72,72,94', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0,2,0', '0,0,1,0', '0', -12, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(701, 'Ataúd Gata', 'Exclusivamente para Vampiros!', '', '', 'Miedo_Gata', '4', 0, 0, -1, 0, 10000, 0, 0, 'D6A3ABE53956', '72,72,84,72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,-1,0,-1,1,-1,2,-1,1,0,2,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(702, 'Miedo_GhostC', 'Descripción', '', '', 'Miedo_GhostC', '4', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(703, 'Lápida', 'Por si te mueres de la risa jugando a BoomBang', '', '', 'Miedo_Gravesize', '4', 1, 0, -1, 0, 500, 0, 0, 'CCC5C0FFF7F097D388', '72,72,80,72,72,100,72,72,83', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,-1,0,0,-1,-1', '0,0,0,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '', '0', 0, 0, -1, NULL, NULL, 0),
(704, 'Chicle Movedizo', 'Pegajoso: Yuks!', '', '', 'Miedo_Gum1', '4', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', -500, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(705, 'Chicle Movedizo', 'Pegajoso: Yuks!', '', '', 'Miedo_Gum2', '4', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', -500, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(706, 'Chicle Movedizo', 'Pegajoso: Yuks!', '', '', 'Miedo_Gum3', '4', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', -500, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(707, 'Chicle Movedizo', 'Pegajoso: Yuks!', '', '', 'Miedo_Gum4', '4', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', -500, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(708, 'Ataúd India', 'Exclusivamente para Vampiros!', '', '', 'Miedo_India', '4', 0, 0, -1, 0, 10000, 0, 0, 'D6A3ABE53956', '72,72,84,72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,-1,0,-1,1,-1,2,-1,1,0,2,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(709, 'Ala Murcielago', 'Ala Murcielago', 'npc', '', 'Miedo_Ingrediente_AlaMurcielago', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(710, 'Anca de rana', 'Anca de rana', '', '', 'Miedo_Ingrediente_AncaRana', '12', 1, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(711, 'Lengua Lagartija', 'Lengua Lagartija', 'npc', '', 'Miedo_Ingrediente_LizardTongue', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(712, 'Pulga', 'Pulga', 'npc', '', 'Miedo_Ingrediente_Pulga', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(713, 'Capa Fantasma', 'Disfraz de un niño desaparecido', 'npc', '', 'Miedo_Ingrediente_SabanaFantasma', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(714, 'Ungüento Oscuro', 'Mejunje básico para pociones.', '', '', 'Miedo_Ingrediente_Unguento', '12', 1, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(715, 'Sangre Zombie', 'Algo verde-espeso-repulsivo', '', '', 'Miedo_Ingrediente_Zomblood', '12', 1, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(716, 'Sangre gigante', 'Sangre gigante', '', '', 'Miedo_Ingrediente2_Blood', '12', 1, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(717, 'Pluma Cuervo', 'Pluma Cuervo', '', '', 'Miedo_Ingrediente2_Feather', '12', 1, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(718, 'Pelo Zombie', 'Incluye piojos.. yuks!', '', '', 'Miedo_Ingrediente2_Hair', '12', 1, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(719, 'Calabaza Podrida', 'Calabaza Podrida', 'npc', '', 'Miedo_Ingrediente2_Pump', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(720, 'Dentadura Zombie', 'Dentadura Zombie', 'concurso', '', 'Miedo_Ingrediente2_Teeth', '17³12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(721, 'Hueso Esqueleto', 'Hueso Esqueleto', '', '', 'Miedo_Ingredientes1_Bone', '17³12', 0, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(722, 'Racimo Boomdor', 'Racimo Boomdor', 'npc', '', 'Miedo_Ingredientes1_Bushel', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(723, 'Ojo Zombie', 'Juraría que te está mirando...', 'npc', '', 'Miedo_Ingredientes1_Eye', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(724, 'Lagartija Tiesa', 'Lagartija Tiesa', 'npc', '', 'Miedo_Ingredientes1_Salamander', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(725, 'Babas Caracol', 'Babas Caracol', 'npc', '', 'Miedo_Ingredientes1_Snail', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(726, 'Ataúd Liliam', 'Exclusivamente para Vampiros!', '', '', 'Miedo_Intelec', '4', 0, 0, -1, 0, 10000, 0, 0, 'D6A3ABE53956', '72,72,84,72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,-1,0,-1,1,-1,2,-1,1,0,2,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(728, 'Ratón pegajoso [NPC]', 'Ítem requerido: x50 Corazón\" Busca Corazón en área \'Cementerio\'\"', '', '', 'Miedo_Mouse', '4', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(729, 'Juguete de Lizzy', 'Lizzy afiló sus dientes de bebé con él', '', '', 'Miedo_MouseA', '4', 0, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(730, 'Sonrisa Diabólica [NPC]', 'Ítem requerido: x50 Mano Izquierda\" Busca Mano Izquierda en área \'Cementerio\'\"', '', '', 'Miedo_PDos', '4', 0, 0, -1, 0, 1000, 0, 0, 'FF1FF8F7F4FFE6EBF2FFCA54', '72,72,100,72,72,100,72,72,95,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '2,0,3,0,2,1,0,-3,0,-2,-1,-2,1,-3,1,-4', '0', -500, 0, 0, '1', '1³0', 1, 0, 1, 9, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(731, 'Pastel desangrado', 'El postre favorito de Mischi', '', '', 'Miedo_Pie', '4', 0, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(732, 'Espectro', 'Serás una criatura de ultratumba', 'pocion', '', 'Miedo_Pipeta_Black', '4', 0, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 11, 420, 0),
(733, 'Murciélago', 'Invoca tu mascota nocturna', 'pocion', '', 'Miedo_Pipeta_Brown', '4', 0, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 3, 120, 0),
(734, 'Apestado', 'Nube apestosa que te sigue', 'pocion', '', 'Miedo_Pipeta_Cyan', '4', 0, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 14, 120, 0),
(735, 'Lengua Trapo', 'Su lengua se hinchará y retorcerá', 'pocion', '', 'Miedo_Pipeta_Dark_Blue', '4', 0, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 5, 120, 0),
(736, 'Sapo', 'Croac!', 'pocion', '', 'Miedo_Pipeta_Dark_Green', '4', 0, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 10, 60, 0),
(737, 'Teleport Master', 'Desplazamiento intramolecular', 'pocion', '', 'Miedo_Pipeta_Dark_Red', '4', 0, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 0, 29, '17 Antiguo', '0', 0, 0, -1, 15, 7, 0),
(738, 'Invisible', 'Nadie sabrá que estás ahi!', 'pocion', '', 'Miedo_Pipeta_Light_Blue', '4', 0, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 7, 120, 0),
(739, 'Acido', 'Sólo quedarán sus huesos..', 'pocion', '', 'Miedo_Pipeta_Light_Green', '4', 0, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 13, 60, 0),
(740, 'Diminuto', 'Ser pequeño tiene sus ventajas', 'pocion', '', 'Miedo_Pipeta_Orange', '4', 0, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 2, 120, 0),
(741, 'Gigante', 'El tamaño sí importa!', 'pocion', '', 'Miedo_Pipeta_Purple', '4', 1, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 1, 120, 0),
(742, 'Teleport', 'Desplazamiento intramolecular', 'pocion', '', 'Miedo_Pipeta_Red', '4', 1, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 8, 7, 0),
(743, 'Miedo_Pipeta_Rose', 'Descripción', 'pocion', '', 'Miedo_Pipeta_Rose', '4', 0, 1, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(744, 'Inversa', 'Para hablar al revés!', 'pocion', '', 'Miedo_Pipeta_Turqoise', '4', 1, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 6, 120, 0),
(745, 'Mudo', 'No podrás articular palabra', 'pocion', '', 'Miedo_Pipeta_Violet', '4', 1, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 4, 120, 0),
(746, 'Fantasma', 'Camina entre los vivos', 'pocion', '', 'Miedo_Pipeta_White', '4', 1, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 12, 420, 0),
(747, 'Rayo', 'Se avecina una tormenta!', 'pocion', '', 'Miedo_Pipeta_Yellow', '4', 1, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 9, 60, 0),
(748, 'Pincel no-muerto  [NPC]', 'Ítem requerido: x50 Mano Derecha\" Busca Mano Derecha en área \'Cementerio\'\"', '', '', 'Miedo_PTres', '4', 0, 1, 20000, 16000, -1, 0, 0, 'FFFAFDFF2BECE0B78AF1F5FF', '72,72,100,72,72,100,72,72,88,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,1,1,0,0,-1', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 9, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(749, 'Calabaza dulce', 'Relleno de terrorífico miedo', '', '', 'Miedo_PumpH', '4', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(750, 'Calabaza Dantesca [NPC]', 'Ítem requerido: x50 Pie Izquierdo\" Busca Pie Izquierdo en área \'Cementerio\'\"', '', '', 'Miedo_PUno', '4', 0, 1, 50000, 40000, -1, 0, 0, '5FFF20EEFFFFF2EFE8D3A745', '72,72,100,72,72,100,72,72,95,72,72,83', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '2,0,3,0,4,0,2,1,3,1,1,3,2,3,1,4,2,4,-2,3,-4,0,0,-4,-1,-4,-2,-3,-1,-3,2,-1,3,-1', '0', -500, 0, 0, '1', '1³0', 1, 3, 1, 9, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(751, 'Retina maligna', 'Chupachups XXL', '', '', 'Miedo_Pupil', '4', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(752, 'Estatua Elaf [NPC]', 'Ítem requerido: x50 Pie Derecho\" Busca Pie Derecho en área \'Cementerio\'\"', 'Trofeo', '', 'Miedo_QtoAjos', '4', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1,1,-1', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(753, 'Ataúd Rastas', 'Exclusivamente para Vampiros!', '', '', 'Miedo_Rasta', '4', 0, 0, -1, 0, 10000, 0, 0, 'D6A3ABE53956', '72,72,84,72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,-1,0,-1,1,-1,2,-1,1,0,2,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(754, 'Sangre aristócrata', 'Miedo_SAristo', 'concurso', '', 'Miedo_SAristo', '17³12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(755, 'Sangre dulce', 'Sangre dulce', 'concurso', '', 'Miedo_SDulce', '17³12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(756, 'Ataúd Marsu', 'Exclusivamente para Vampiros!', '', '', 'Miedo_Seta', '4', 0, 0, -1, 0, 10000, 0, 0, 'D6A3ABE53956', '72,72,84,72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,-1,0,-1,1,-1,2,-1,1,0,2,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(757, 'Ectoplasma', 'Ectoplasma', 'concurso', '', 'Miedo_SFanta', '17³12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(758, 'Sangre fresca', 'Sangre fresca', 'concurso', '', 'Miedo_SFresca', '17³12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(759, 'Sangre de muerto', 'Sangre de muerto', 'concurso', '', 'Miedo_SMuerto', '17³12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(760, 'Olga ojos azules', 'Deliciosamente presumida', '', '', 'Miedo_Spider', '4', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(761, 'Sangre de vampiro', 'Densa y oscura.. para que servirá?', 'concurso', '', 'Miedo_SSoul', '17³12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(762, 'Colmillos azucarados', 'Dulces', '', '', 'Miedo_Teeth', '4', 0, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '-1,-1,-2,-1,1,1,0,2,1,2', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(763, 'Caramelo fétido [NPC]', 'Ítem requerido: x50 Cerebro\" Busca Cerebro en área \'Cementerio\'\"', '', '', 'Miedo_Toffee', '4', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(764, 'Estatua Lizzy [NPC]', 'Ítem requerido: x50 Hueso Esqueleto\" Busca Hueso Esqueleto en área \'Cementerio\'\"', 'Trofeo', '', 'Miedo_TresAjos', '4', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1,1,-1', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(766, 'Lobo Salvaje', 'Aulla', '', '', 'Miedo_Wolf_2', '4', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(767, 'Ataúd Yayo', 'Exclusivamente para Vampiros!', '', '', 'Miedo_Yayo', '4', 0, 0, -1, 0, 10000, 0, 0, 'D6A3ABE53956', '72,72,84,72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,-1,0,-1,1,-1,2,-1,1,0,2,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(768, 'Mina', 'Pon unas cuantas... Para intimidar a tus enemigos! ;DDD', '', '', 'mina', '1', 1, 0, -1, 0, 20, 0, 3, '087BA7', '72,72,66', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(769, 'Molusco', 'Si te gusta...', '', '', 'molusco', '1', 1, 0, -1, 0, 10, 0, 0, 'E97E75', '72,72,92', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '', '0', -50, 0, -50, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(770, 'Monstruo Marino', '¡Arrr! ¡Un monstruo marino gigante! Traerá visitantes de cada rincón de los siete mares a tus islas.', '', '', 'monster_sea', '1', 1, 0, -1, 0, 4000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,-1,-1,0,0,1,1,2,2,2,2,1,1,1,1,0,0,-1,1,-1,2,0', '0,0,1,-1,0,-1,1,1,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(771, 'Otto', 'Le encantaría poder mover la mano derecha', '', '', 'mummy1', '4', 1, 0, -1, 0, 1000, 0, 0, 'E7BFA5', '72,72,91', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(772, 'Karl', 'No conseguirá volar nunca', '', '', 'mummy2', '4', 1, 0, -1, 0, 1000, 0, 0, 'FEBAD5', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(773, 'Frie', 'Pariente de tutankhamun', '', '', 'mummy3', '4', 1, 0, -1, 0, 1000, 0, 0, '96A7FE', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(774, 'Mundial Boomer Bronce', 'Mundial Boomer Bronce', 'Trofeo', '', 'Mundial_Boomer_Bronce', '1', 1, 1, 10000, 8000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(775, 'Mundial Boomer Oro', 'Mundial Boomer Oro', 'Trofeo', '', 'Mundial_Boomer_Oro', '1', 1, 1, 50000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(776, 'Mundial Boomer Plata', 'Mundial Boomer Plata', 'Trofeo', '', 'Mundial_Boomer_Plata', '1', 1, 1, 25000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(777, 'Mundial Bruja Bronce', 'Mundial Bruja Bronce', 'Trofeo', '', 'Mundial_Bruja_Bronce', '1', 1, 1, 10000, 8000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(778, 'Mundial Bruja Oro', 'Mundial Bruja Oro', 'Trofeo', '', 'Mundial_Bruja_Oro', '1', 1, 1, 50000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(779, 'Mundial Bruja Plata', 'Mundial Bruja Plata', 'Trofeo', '', 'Mundial_Bruja_Plata', '1', 1, 1, 25000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(780, 'Mundial Cascos Bronce', 'Mundial Cascos Bronce', 'Trofeo', '', 'Mundial_Cascos_Bronce', '1', 1, 1, 10000, 8000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(781, 'Mundial Cascos Oro', 'Mundial Cascos Oro', 'Trofeo', '', 'Mundial_Cascos_Oro', '1', 1, 1, 50000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(782, 'Mundial Cascos Plata', 'Mundial Cascos Plata', 'Trofeo', '', 'Mundial_Cascos_Plata', '1', 1, 1, 25000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(783, 'Mundial Cholo Bronce', 'Mundial Cholo Bronce', 'Trofeo', '', 'Mundial_Cholo_Bronce', '1', 1, 1, 10000, 8000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(784, 'Mundial Cholo Oro', 'Mundial Cholo Oro', 'Trofeo', '', 'Mundial_Cholo_Oro', '1', 1, 1, 50000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(785, 'Mundial Cholo Plata', 'Mundial Cholo Plata', 'Trofeo', '', 'Mundial_Cholo_Plata', '1', 1, 1, 25000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(786, 'Mundial Empollon Bronce', 'Mundial Empollon Bronce', 'Trofeo', '', 'Mundial_Empollon_Bronce', '1', 1, 1, 10000, 8000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(787, 'Mundial Empollon Oro', 'Mundial Empollon Oro', 'Trofeo', '', 'Mundial_Empollon_Oro', '1', 1, 1, 50000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(788, 'Mundial Empollon Plata', 'Mundial Empollon Plata', 'Trofeo', '', 'Mundial_Empollon_Plata', '1', 1, 1, 25000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(789, 'Mundial Gata Bronce', 'Mundial Gata Bronce', 'Trofeo', '', 'Mundial_Gata_Bronce', '1', 1, 1, 10000, 8000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(790, 'Mundial Gata Oro', 'Mundial Gata Oro', 'Trofeo', '', 'Mundial_Gata_Oro', '1', 1, 1, 50000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(791, 'Mundial Gata Plata', 'Mundial Gata Plata', 'Trofeo', '', 'Mundial_Gata_Plata', '1', 1, 1, 25000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(792, 'Porteria', 'Mundial Goal Post', '', '', 'Mundial_Goal_Post', '1', 1, 1, 20000, 16000, -1, 0, 0, 'D39371F29259DBC4A5BFFF51', '72,72,83,72,72,95,72,72,86,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '2,4,3,3,2,2,1,1,1,2,2,3,1,3,1,4,1,5,1,0,2,0,2,1,1,-1,2,-1,3,-2,2,-2,0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(793, 'Mundial India Bronce', 'Mundial India Bronce', 'Trofeo', '', 'Mundial_India_Bronce', '1', 1, 1, 10000, 8000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(794, 'Tronco grabado', 'Que todo el mundo sepa que le quieres!', '', '', 'log', '7', 1, 0, -1, 0, 600, 0, 0, 'CEA254FFC7C3EBF8FFBFDD6B', '72,72,81,72,72,100,72,72,100,72,72,87', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,-1,0,1,0,-1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '', '0', 0, 0, -1, NULL, NULL, 0),
(795, 'Piruleta', 'Para los que no estan enamorados pero tienen hambre!', '', '', 'lollipop', '7', 1, 0, -1, 0, 100, 0, 0, 'C6C38FFF262FFFF0F8', '72,72,78,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(796, 'Mundial India Oro', 'Mundial India Oro', 'Trofeo', '', 'Mundial_India_Oro', '1', 1, 1, 50000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(797, 'Mundial India Plata', 'Mundial India Plata', 'Trofeo', '', 'Mundial_India_Plata', '1', 1, 1, 25000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(798, 'Mundial Liliam Bronce', 'Mundial Liliam Bronce', 'Trofeo', '', 'Mundial_Liliam_Bronce', '1', 1, 1, 10000, 8000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(799, 'Mundial Liliam Oro', 'Mundial Liliam Oro', 'Trofeo', '', 'Mundial_Liliam_Oro', '1', 1, 1, 50000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(800, 'Mundial Liliam Plata', 'Mundial Liliam Plata', 'Trofeo', '', 'Mundial_Liliam_Plata', '1', 1, 1, 25000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(801, 'Mundial Marsu Bronce', 'Mundial Marsu Bronce', 'Trofeo', '', 'Mundial_Marsu_Bronce', '1', 1, 1, 10000, 8000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(802, 'Trofeo Mundial', 'Mundial Marsu Oro', 'Trofeo', '', 'Mundial_Marsu_Oro', '1', 1, 1, 50000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(803, 'Trofeo Mundial', 'Mundial Marsu Plata', 'Trofeo', '', 'Mundial_Marsu_Plata', '1', 1, 1, 25000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(804, 'Trofeo Mundial', 'Mundial Rastas Bronce', 'Trofeo', '', 'Mundial_Rastas_Bronce', '1', 1, 1, 10000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(805, 'Trofeo Mundial', 'Mundial Rastas Oro', 'Trofeo', '', 'Mundial_Rastas_Oro', '1', 1, 1, 50000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(806, 'Trofeo Mundial', 'Mundial Rastas Plata', 'Trofeo', '', 'Mundial_Rastas_Plata', '1', 1, 1, 25000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(807, 'Trofeo Mundial', 'Mundial Yayo Bronce', 'Trofeo', '', 'Mundial_Yayo_Bronce', '1', 1, 1, 10000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(808, 'Trofeo Mundial', 'Mundial Yayo Oro', 'Trofeo', '', 'Mundial_Yayo_Oro', '1', 1, 1, 50000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(809, 'Trofeo Mundial', 'Mundial Yayo Plata', 'Trofeo', '', 'Mundial_Yayo_Plata', '1', 1, 1, 25000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(810, 'Hemoglobino', 'Cuenta la leyenda que se alimentan de sangre...', '', '', 'murcielago1', '4', 1, 0, -1, 0, 400, 0, 0, '616AA2', '72,72,64', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 8, '', '0', 0, 0, -1, NULL, NULL, 0),
(811, 'Linfocito', 'Cuenta la leyenda que se alimentan de sangre...', '', '', 'murcielago2', '4', 1, 0, -1, 0, 400, 0, 0, '954743', '72,72,59', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 8, '', '0', 0, 0, -1, NULL, NULL, 0),
(812, 'Trombocito', 'Cuenta la leyenda que se alimentan de sangre...', '', '', 'murcielago3', '4', 1, 0, -1, 0, 400, 0, 0, '4C9569', '72,72,59', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 8, '', '0', 0, 0, -1, NULL, NULL, 0),
(813, 'Setas', 'Que fresquito se esta aquí debajo...!', '', '', 'mushrooms', '2', 1, 0, -1, 0, 10, 0, 0, '0577AFFEF2D41BC8FE', '72,72,69,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(814, 'Musical_Love', 'Descripción', '', 'Si', 'Musical_Love', '7', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(815, 'Tren Eléctrico', '', '', '', 'Navidad_Train', '8', 1, 1, 20000, 16000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,0,-1,1,0,1,0,2,-2,0,-3,-1,-3,-2,-2,-2,-1,-3,0,-2,1,2,1,3,2,3,3,3,3,2,3,1,3,0,2,-1,1,-1,1,-2,-1,-1,-1,-2,-2,-1,1,0,1,1,2,1,2,2,2,0,0,-1', '0,0,-1,0,2,1,1,0,1,1,0,1,1,2,2,3,2,2,3,2,4,3,4,4,4,5,3,3', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(816, 'Arco de Muérdago', 'La tradición navideña es muy clara: dos personas', '', '', 'Nieve_Arch', '1', 1, 0, -1, 0, 500, 0, 0, 'FFFAFDF213466EE054F1F5FF', '72,72,100,72,72,95,72,72,88,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '-1,-1,-2,-1,-2,0,-1,0,1,1,0,1,0,2,1,2', '-2,-1,-1,-1,1,1,1,2', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(817, 'Bebé Pingüino [NPC]', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', '', '', 'Nieve_BabyP', '6', 0, 0, -1, 0, 1000, 0, 0, '817A87', '72,72,53', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(818, 'Bailarina', 'Ella baila como si nadie le estuviera mirando.', '', '', 'Nieve_Baller', '8', 1, 0, -1, 0, 250, 0, 0, 'DBBEA7FFBACFFFECC8877155', '72,72,86,72,72,100,72,72,100,72,72,53', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '', '0', 0, 0, -1, NULL, NULL, 0),
(819, 'Bola de nieve', '', 'concurso', '', 'Nieve_BolaC', '17³12', 0, 1, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(820, 'Seto Navideño', 'Seto navideño con leds multicolor personalizables. Sólo disponible en Navidad.', '', '', 'Nieve_Bush', '1', 1, 0, -1, 0, 150, 0, 0, '5EBF6B', '72,72,75', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '', '0', 0, 0, -1, NULL, NULL, 0),
(821, 'Casa de Chocolate', 'Cómetela antes de que se derrita!', '', '', 'Nieve_ChocHouse', '6', 0, 0, -1, 0, 1500, 0, 0, 'C68D79FF354CCFE1E8', '72,72,78,72,72,100,72,72,91', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '-1,-1,0,-1,-1,0,0,0,1,0,0,1,1,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(822, 'Bola oso ', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', '', '', 'Nieve_FanArt1', '6', 0, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(823, 'Bola pingüino ', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', '', '', 'Nieve_FanArt2', '6', 0, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(824, 'Bola casita', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', '', '', 'Nieve_FanArt3', '6', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(825, 'Galletas Navideñas', 'Humeantes', '', '', 'Nieve_Galletas', '8', 0, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(826, 'Hombre Gengibre', 'Resistirás la tentación de morderlo?', '', '', 'Nieve_GingerB', '8', 0, 0, -1, 0, 1000, 0, 0, 'B2894E37F6FF5E4B42FFA8DF', '72,72,70,72,72,100,72,72,37,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', -500, 0, 0, '1', '1³0', 1, 0, 1, 3, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(827, 'Gramófono', 'Enciende el gramófono y escoge tus villancicos favoritos. Sólo disponible en Navidad!', '', '', 'Nieve_Gramopho', '8', 1, 0, -1, 0, 2000, 0, 0, 'CCB1AFB5ABA4A89B84D1B598', '72,72,80,72,72,71,72,72,66,72,72,82', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,0,1,0,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '', '0', 0, 0, -1, NULL, NULL, 0),
(828, 'Super-Keko', 'Colecciona tus Super-Kekos!', '', '', 'Nieve_HBald', '8', 1, 1, 50000, 40000, -1, 0, 0, 'FD54FFD0F29BE85BDEDAD7E2', '72,72,100,72,72,95,72,72,91,72,72,89', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(829, 'Super-Keko', 'Colecciona tus Super-Kekos!', '', '', 'Nieve_HBot', '8', 1, 1, 50000, 40000, -1, 0, 0, 'BEEBFFE6E1F2', '72,72,100,72,72,95', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(830, 'Super-Keko', 'Colecciona tus Super-Kekos!', '', '', 'Nieve_HCat', '8', 1, 1, 50000, 40000, -1, 0, 0, 'FF76BFAF683EFFDCB2AAAFCC', '72,72,100,72,72,69,72,72,100,72,72,80', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(831, 'Super-Keko', 'Colecciona tus Super-Kekos!', '', '', 'Nieve_HDetect', '8', 1, 1, 50000, 40000, -1, 0, 0, 'E5C8A5FFCF98E0A855C97C52', '72,72,90,72,72,100,72,72,88,72,72,79', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(832, 'Casco cross', '', '', '', 'Nieve_Helmet', '8', 1, 0, -1, 0, 1000, 0, 0, 'BCD3FFE8C292AEDD80FFFC99', '72,72,100,72,72,91,72,72,87,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(833, 'Caja Super-Keko', 'Esta caja contiene un superhéroe', '', '', 'Nieve_HeroeFema', '8', 0, 1, 50000, 40000, -1, 0, 0, 'FF7538EFA87CC6EDFF', '72,72,100,72,72,94,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 11, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(834, 'Caja Super-Keko', 'Esta caja contiene un superhéroe', '', '', 'Nieve_HeroeMale', '8', 0, 1, 50000, 40000, -1, 0, 0, 'A7C9F98BF4B7C6EDFF', '72,72,98,72,72,96,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 11, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(835, 'Super-Keko', 'Colecciona tus Super-Kekos!', '', '', 'Nieve_HGas', '8', 1, 1, 50000, 40000, -1, 0, 0, 'B1B7805B5A5BFFB07D7EAEE0', '72,72,72,72,72,36,72,72,100,72,72,88', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0);
INSERT INTO `objetos` (`id`, `titulo`, `descripcion`, `Especial`, `colores_mal`, `swf`, `categoria`, `visible`, `visible_mod`, `precio_oro`, `oro_descuento`, `precio_plata`, `vip`, `espacio_mapabytes`, `colores_hex`, `colores_rgb`, `parte_1`, `parte_2`, `parte_3`, `parte_4`, `tam_p`, `tam_n`, `espacio_ocupado_n`, `espacio_2_0`, `tam_g`, `something_4`, `something_5`, `something_6`, `arrastrable`, `salas_usables`, `intercambiable`, `tipo_rare`, `rotacion`, `tipo_arrastre`, `Definicion`, `default_data`, `limitado`, `ofertas`, `precio_anterior`, `efecto_id`, `tiempo_pocion`, `img`) VALUES
(836, 'Super-Keko', 'Colecciona tus Super-Kekos!', '', '', 'Nieve_HNinja', '8', 1, 1, 50000, 40000, -1, 0, 0, 'EDB984FF8C170C0C0C5B5358', '72,72,93,72,72,100,72,72,5,72,72,36', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(837, 'Super-Keko', 'Colecciona tus Super-Kekos!', '', '', 'Nieve_HSamu', '8', 1, 1, 50000, 40000, -1, 0, 0, '997051F2C869ED7D48D6B27F', '72,72,60,72,72,95,72,72,93,72,72,84', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(838, 'Super-Keko', 'Colecciona tus Super-Kekos!', '', '', 'Nieve_HScient', '8', 1, 1, 50000, 40000, -1, 0, 0, 'E8F6FFEAB067EDE6E6', '72,72,100,72,72,92,72,72,93', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(839, 'Super-Keko', 'Colecciona tus Super-Kekos!', '', '', 'Nieve_HSpider', '8', 0, 1, 50000, 40000, -1, 0, 0, 'E1E5FFEA2A30FFB4B1', '72,72,100,72,72,92,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(840, 'Super-Keko', 'Colecciona tus Super-Kekos!', '', '', 'Nieve_HSuper', '8', 1, 1, 50000, 40000, -1, 0, 0, '568DFFFF5B52FFC793817682', '72,72,100,72,72,100,72,72,100,72,72,51', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(841, 'Super-Keko', 'Colecciona tus Super-Kekos!', '', '', 'Nieve_HTrek', '8', 1, 1, 50000, 40000, -1, 0, 0, 'FF525FFFCC9A777077C9DDE5', '72,72,100,72,72,100,72,72,47,72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(842, 'Keko de nieve', 'Consíguelo antes de que se derritan', '', '', 'Nieve_Keko1', '6', 1, 0, -1, 0, 2000, 0, 0, '74FFFFB3B2B5', '72,72,100,72,72,71', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,-1,-1,0,0,-1,0,0,1,0,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(843, 'Keko de nieve', 'Consíguelo antes de que se derritan', '', '', 'Nieve_Keko2', '6', 1, 0, -1, 0, 2000, 0, 0, 'FFD16B', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,-1,-1,0,0,-1,0,0,1,0,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(844, 'Keko de nieve', 'Consíguelo antes de que se derritan', '', '', 'Nieve_Keko3', '6', 1, 0, -1, 0, 2000, 0, 0, 'FEF4FF8FEBFFFE1626FF606B', '72,72,100,72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,-1,-1,0,0,-1,0,0,1,0,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(845, 'Keko de nieve', 'Consíguelo antes de que se derritan', '', '', 'Nieve_Keko4', '6', 1, 0, -1, 0, 2000, 0, 0, 'F8EFF9708468', '72,72,98,72,72,52', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,-1,-1,0,0,-1,0,0,1,0,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(846, 'Keko de nieve', 'Consíguelo antes de que se derritan', '', '', 'Nieve_Keko5', '6', 1, 0, -1, 0, 2000, 0, 0, 'A9FFB3F0E7FF8C9B8B', '72,72,100,72,72,100,72,72,61', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,-1,-1,0,0,-1,0,0,1,0,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(847, 'Keko de nieve', 'Consíguelo antes de que se derritan', '', '', 'Nieve_Keko6', '6', 1, 0, -1, 0, 2000, 0, 0, '62B261D8FFA0766E77', '72,72,70,72,72,100,72,72,47', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,-1,-1,0,0,-1,0,0,1,0,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(848, 'Keko de nieve', 'Consíguelo antes de que se derritan', '', '', 'Nieve_Keko7', '6', 1, 0, -1, 0, 2000, 0, 0, 'BCEF85CCCAC8', '72,72,94,72,72,80', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,-1,-1,0,0,-1,0,0,1,0,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(849, 'Keko de nieve', 'Consíguelo antes de que se derritan', '', '', 'Nieve_Keko8', '6', 1, 0, -1, 0, 2000, 0, 0, 'EFB257', '72,72,94', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,-1,-1,0,0,-1,0,0,1,0,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(850, 'Keko de nieve', 'Consíguelo antes de que se derritan', '', '', 'Nieve_Keko9', '6', 1, 0, -1, 0, 2000, 0, 0, 'CB0093FF2ECF96407A', '72,72,80,72,72,100,72,72,59', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,-1,-1,0,0,-1,0,0,1,0,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(851, 'Keko de nieve', 'Consíguelo antes de que se derritan', '', '', 'Nieve_Keko10', '6', 1, 0, -1, 0, 2000, 0, 0, '5F5C63F5FFFC', '72,72,39,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,-1,-1,0,0,-1,0,0,1,0,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(852, 'Keko de nieve', 'Consíguelo antes de que se derritan', '', '', 'Nieve_Keko11', '6', 1, 0, -1, 0, 2000, 0, 0, '80C4FFFF5936', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,-1,-1,0,0,-1,0,0,1,0,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(853, 'Keko de nieve', 'Consíguelo antes de que se derritan', '', '', 'Nieve_Keko12', '6', 1, 0, -1, 0, 2000, 0, 0, 'FFD7F3FFC8E1AEE07D444443', '72,72,100,72,72,100,72,72,88,72,72,27', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,-1,-1,0,0,-1,0,0,1,0,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(854, 'Moto', '100%% ecológica. 100%% adrenalina. 100%% libertad.', '', '', 'Nieve_motoX2', '8', 1, 0, -1, 0, 1000, 0, 0, 'ACEA6AFFE786F3F7CDE4FBFF', '72,72,92,72,72,100,72,72,97,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,0,-1,1', '0,0,-1,0,-2,0,-2,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(855, 'Regalo', '', '', '', 'Nieve_Presents', '8', 1, 0, -1, 0, 400, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,-1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(856, 'Quad', 'Ligero como una moto', '', '', 'Nieve_Quad', '8', 1, 0, -1, 0, 1000, 0, 0, 'A1A5A1A2D8FFDAF7C8FFAF3F', '72,72,65,72,72,100,72,72,97,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,0,1,0', '0,0,-1,0,1,0,-1,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(857, 'Regalo azul', '', 'npc', '', 'Nieve_RAzul', '17', 0, 0, -1, 0, 4000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,2,2', '0', 2, 2, 2, '2', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(858, 'Reno friolero', 'No le gusta el frío', '', '', 'Nieve_Reno1', '6', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(859, 'Reno friolero', 'No le gusta el frío', '', '', 'Nieve_Reno2', '6', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(860, 'Reno friolero', 'No le gusta el frío', '', '', 'Nieve_Reno3', '6', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(861, 'Reno friolero', 'No le gusta el frío', '', '', 'Nieve_Reno4', '6', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(862, 'Reno friolero', 'No le gusta el frío', '', '', 'Nieve_Reno5', '6', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(863, 'Reno friolero', 'No le gusta el frío', '', '', 'Nieve_Reno6', '6', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(864, 'Regalo lila', '', 'npc', '', 'Nieve_RLila', '17', 0, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(865, 'Robot gigante', 'Un coloso de mas de 4 metros!', '', '', 'Nieve_Robot', '8', 0, 1, 20000, 16000, -1, 0, 0, 'CEE6F2CDEFEFFFAF37B7F6FF', '72,72,95,72,72,94,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,-1,1,-1,1,0,1,1,2,1,1,2', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(866, 'Regalo rojo', '', 'npc', '', 'Nieve_RRojo', '17', 0, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(867, 'Cubo de colores', '', '', '', 'Nieve_Rubik', '8', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(868, 'Regalo verde', '', 'npc', '', 'Nieve_RVerde', '17', 0, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(869, 'Osito gigante', 'Osito extremadamente cariñoso', '', '', 'Nieve_Teddy', '8', 0, 0, -1, 0, 25000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1,0,1,-1,-1,0,-1,1,-1,-1,0,0,0,1,0,0,1,1,1,-1,2,0,2,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(870, 'Telescopio', '', '', '', 'Nieve_Telescope', '8', 1, 0, -1, 0, 1000, 0, 0, 'A1A5A1CAD7DBC0F3F7C8CBD1', '72,72,65,72,72,86,72,72,97,72,72,82', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(871, 'Ticket dorado', 'Ticket para la lotería. Puedes ganar el lote total de:', '', '', 'Nieve_Ticket', '17', 1, 0, 2000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(872, 'Árbol de Navidad', 'Santa vendrá el 25 de diciembre y dejará un regalito junto al árbol. No te olvides de abrirlo', '', '', 'Nieve_Tree', '6', 1, 0, -1, 0, 3000, 0, 0, '8CCC44FFCA54FC3656FFD52E', '72,72,80,72,72,100,72,72,99,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,-2,-2,-2,-2,-1,-2,0,-2,1,-2,2,-1,2,0,2,1,2,2,2,2,1,2,0,0,-2,1,-1,0,-1,-1,-1,-1,0,-1,1,1,1,1,0,0,1,1,-2,2,-2,2,-1', '2,-1,2,0,2,1,1,-2,1,-1,1,0,1,1,1,2,0,-2,0,-1,0,0,0,1,0,2,-1,-2,-1,-1,-1,0,-1,1,-1,2,-2,-1,-2,0,-2,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '', '0', 0, 0, -1, NULL, NULL, 0),
(873, 'Trineo GT', 'De 0 a 100 en 3.8 segundos', '', '', 'Nieve_Trineo', '6', 1, 0, -1, 0, 75, 0, 0, 'FF4A61EDD4B2', '72,72,100,72,72,93', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,-1,0,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(874, 'Trofeo Bronce [NPC]', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', 'Trofeo', '', 'Nieve_TrofeoB', '6', 0, 1, 10000, 8000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(875, 'Minitrofeo Bronce [NPC]', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', 'Trofeo', '', 'Nieve_TrofeoBs', '6', 0, 1, 10000, 8000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(876, 'Trofeo Oro [NPC]', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', 'Trofeo', '', 'Nieve_TrofeoG', '6', 0, 1, 50000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(877, 'Minitrofeo Oro [NPC]', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', 'Trofeo', '', 'Nieve_TrofeoGs', '6', 0, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(878, 'Trofeo Plata [NPC]', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', 'Trofeo', '', 'Nieve_TrofeoS', '6', 0, 1, 25000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(879, 'Minitrofeo Plata [NPC]', 'Ítem requerido: x50 Donut congelado\" Busca Donut congelado en área \'BosqueNevado\'\"', 'Trofeo', '', 'Nieve_TrofeoSs', '6', 0, 1, 25000, 20000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(880, 'Pavo Navideño', 'Tiempo de cocción: 1 hora', '', '', 'Nieve_Turkey', '8', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-2,0,-1,1,0,2,-1,0,0,1', '0,0,1,0,0,-1,1,-1', '0', -20, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(881, 'Valla Navideña', 'Organiza tu espacio con un toque entrañable y navideño. Sólo disponible en Navidad.', '', '', 'Nieve_Valla', '1', 1, 0, -1, 0, 150, 0, 0, 'C1A791FFE734', '72,72,76,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0', '0,0,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(882, 'Micrófono Nocilla', 'Anímate y canta conmigo en el coro más divertido del mundo', '', '', 'Nocilla_Bisbal', '300', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(883, 'Movil Nokia', '', '', '', 'Nokia_Phone', '300', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(884, 'Carta de Amor', '¿Quieres a alguien pero no lo sabe? Diselo con esta carta.', '', '', 'note', '7', 1, 0, -1, 0, 400, 0, 0, 'DDD4C2FF6277000000', '72,72,87,72,72,100,72,72,0', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(885, 'Origami Grulla', '', '', '', 'orientBird', '13', 1, 1, 20000, 16000, -1, 1, 0, 'E6EECA', '72,72,94', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(886, 'Origami Bote', '', '', '', 'orientBoat', '13', 1, 1, 20000, 16000, -1, 1, 0, 'E6EECA', '72,72,94', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(887, 'Bonsai', 'Ayuda a potenciar tu paciencia', '', '', 'orientBonsai', '13', 1, 0, -1, 0, 500, 0, 0, 'DD8B59CEC6A2A5EA8F', '72,72,87,72,72,81,72,72,92', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(888, 'Dojo', 'Lugar para la búsqueda de la perfección física', '', '', 'orientDojo', '13', 1, 0, -1, 0, 3000, 0, 0, 'BABFADC9C5AACEB8A8E89191', '72,72,75,72,72,79,72,72,81,72,72,91', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,0,1,-1,1,-2,1,-2,0,-2,-1,-2,-2,-1,-2,0,-2,1,-1,2,1,2,2,1,2,0,2,-2,2,1,1,-1,-1,-1,0,1,0,0,-1,2,0,2,-1,1,-2,2,-2,-1,2', '0,0,0,1,0,-1,0,-2,1,0,2,0,3,0,-1,0,-2,0,1,1,2,1,2,2,-1,1,-2,1,-2,2,1,-1,-1,-1,-1,-2,-2,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 2, '', '0', 0, 0, -1, NULL, NULL, 0),
(889, 'Origami Ryu', '', '', '', 'orientDragon', '13', 1, 0, -1, 0, 5000, 1, 0, 'E6EECAA35138', '72,72,94,72,72,64', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,-1,-1,0,-1,1,-1,-2,-2,-1,-2,-1,-3', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(890, 'Origami Koi', '', '', '', 'orientFish', '13', 1, 1, 20000, 16000, -1, 1, 0, 'E6EECA', '72,72,94', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,2,0,-1,0,-2,0,1,1,0,1,-1,1', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(891, 'Origami Cisne', '', '', '', 'orientGanso', '13', 1, 1, 20000, 16000, -1, 1, 0, 'E6EECA', '72,72,94', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(892, 'Okiya', 'Antiguo lugar de alojamiento y formación para jóvenes aspirantes a geisha.', '', '', 'orientGeishaH', '13', 1, 0, -1, 0, 3000, 0, 0, 'AFBF9BCADDD6E8BDBCB3F2EA', '72,72,75,72,72,87,72,72,91,72,72,95', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,0,1,-1,2,0,2,1,2,2,2,2,1,1,1,-1,1,-1,0,-1,-1,-1,-2,-1,-3,0,-3,2,0,1,-1,1,0,0,-1,0,-2,1,-2,2,-1', '0,0,0,1,0,2,0,3,0,-1,0,-2,1,0,-1,0,1,1,1,2,1,3,2,2,2,3,-1,1,-1,2,-1,3,-1,-1,-1,-2,-2,-2', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 2, '', '0', 0, 0, -1, NULL, NULL, 0),
(893, 'Incienso', 'Aromatiza tu isla con incienso de oriente y sorprende a tus amigos!', '', '', 'orientInsense', '13', 1, 0, -1, 0, 200, 0, 0, 'AD78C9EAE5A5', '72,72,79,72,72,92', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(894, 'Katana', 'Testigo mudo de tus hazañas como samurai.', '', '', 'orientKatana', '13', 1, 0, -1, 0, 500, 0, 0, 'CEA2B2FC950CC0D6D3C6B494', '72,72,81,72,72,99,72,72,84,72,72,78', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(895, 'Farolillo', 'Sencillez', '', '', 'orientLamp', '13', 1, 0, -1, 0, 100, 0, 0, 'EF666E', '72,72,94', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(896, 'Papel', '', '', '', 'orientPapel', '13', 1, 1, 20000, 16000, -1, 1, 0, 'E6EECA', '72,72,94', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 11, '', '0', 0, 0, -1, NULL, NULL, 0),
(897, 'Origami Avion', '', '', '', 'orientPlane', '13', 1, 1, 20000, 16000, -1, 1, 0, 'E6EECA', '72,72,94', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 10, '', '0', 0, 0, -1, NULL, NULL, 0),
(898, 'Palo de combate', 'Este milenario instrumento de lucha no necesita balas ni flechas; solamente honor y destreza.', '', '', 'orientPole', '13', 1, 0, -1, 0, 400, 0, 0, 'D3BC91EFBBCF', '72,72,83,72,72,94', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(899, 'Estanque Koi', 'Nenúfares', '', '', 'orientPond', '13', 1, 0, -1, 0, 1000, 0, 0, '7EC7CE92BA60C1D8D3FF9FE5', '72,72,81,72,72,73,72,72,85,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,-1,-2,0,-2,1,-1,2,0,2,1,2,2,1,2,0,2,-1,1,-2,0,-2,-1,-2,-2,-1,1,1,0,1,-1,1,-1,0,0,-1,1,-1,1,0', '0,0,1,0,2,0,-1,0,-2,0,1,1,2,1,0,1,-1,1,-2,1,0,-1,0,-2,1,-1,-1,-1,-2,-1,-1,-2,-1,2,0,2,1,2', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(900, 'Shuriken', 'Recuerda', '', '', 'orientShuriken', '13', 1, 0, -1, 0, 200, 0, 0, 'C9C5C7', '72,72,79', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(901, 'Wagasa', 'Sombrilla tradicional japonesa hecha de Bambu y Washi. Se entregan con grabado artesano.', '', '', 'orientSomb0', '13', 1, 0, 1000, 0, -1, 0, 0, 'FFE4C0FCF1D8', '72,72,100,72,72,99', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 11, '', '0', 0, 0, -1, NULL, NULL, 0),
(902, 'Wagasa Bambú', '', '', '', 'orientSomb1', '13', 0, 0, 1000, 0, -1, 0, 0, 'FFE4C0FC8D8D', '72,72,100,72,72,99', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(903, 'Wagasa Dragon', '', '', '', 'orientSomb2', '13', 0, 1, 2000, 1600, -1, 0, 0, 'FFE4C0BAEBFFE7FFF9F5D3FF', '72,72,100,72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(904, 'Wagasa Playera', '', '', '', 'orientSomb3', '13', 0, 0, 1000, 0, -1, 0, 0, 'FFE4C0FFFDE8E86E5F', '72,72,100,72,72,100,72,72,91', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(905, 'Wagasa Nenúfar', '', '', '', 'orientSomb4', '13', 0, 0, 1000, 0, -1, 0, 0, 'FFE4C0C8FFE5FFF997C9FFFC', '72,72,100,72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(906, 'Wagasa Ki', '', '', '', 'orientSomb5', '13', 0, 1, 2000, 1600, -1, 0, 0, 'FFE4C0FFE8C2ECFFF9F7FFCB', '72,72,100,72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(907, 'orientSombrilla0', 'Descripción', '', 'Si', 'orientSombrilla0', '13', 0, 0, -1, 0, 1500, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(908, 'orientSombrilla1', 'Descripción', '', 'Si', 'orientSombrilla1', '13', 0, 0, -1, 0, 1500, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(909, 'orientSombrilla2', 'Descripción', '', 'Si', 'orientSombrilla2', '13', 0, 0, -1, 0, 1500, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(910, 'orientSombrilla3', 'Descripción', '', 'Si', 'orientSombrilla3', '13', 0, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(911, 'orientSombrilla4', 'Descripción', '', 'Si', 'orientSombrilla4', '13', 0, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(912, 'orientSombrilla5', 'Descripción', '', 'Si', 'orientSombrilla5', '13', 0, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(913, 'Chadogu', '¿Preparado para conocer el camino del té?', '', '', 'orientTea', '13', 1, 0, -1, 0, 500, 0, 0, 'DBD7C1A3EBFFEA141FDAE2E2', '72,72,86,72,72,100,72,72,92,72,72,89', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(914, 'Oso Noel', '', '', '', 'oso', '8', 1, 0, -1, 0, 1500, 0, 0, '8E6521E2B47FFF2A19', '72,72,56,72,72,89,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(915, 'Oso Polar', 'Nadie por aqui', '', '', 'osoalto', '6', 1, 0, -1, 0, 1000, 0, 0, 'AAE5FF', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(916, 'Oso baby', 'De mayor quiere ser como su padre', '', '', 'osobaby', '6', 1, 0, -1, 0, 75, 0, 0, 'CEF6FF', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(917, 'Oso Freezo', 'Siempre ha pensado que deberia haber nacido en el Caribe...', '', '', 'osohelado', '6', 1, 0, -1, 0, 1200, 0, 0, 'DBFFFBFF9C40', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,-1,-1,0,0,1,1,1,2,0,1,0,0,-1,0,-2,1,-2,2,-2,2,-1', '0,0,0,-1,1,0,1,1,-1,-1,1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(918, 'Nave', 'Una maravilla de la ingeniería alienígena', '', '', 'ovni_gigante', '9', 0, 1, -1, 0, 5000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(919, 'Palmeras', 'Qué es una playa paradisíaca sin palmeras?', '', '', 'palmeras', '1', 1, 0, -1, 0, 100, 0, 0, '89713704B40E', '72,72,54,72,72,71', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(920, 'Poste', 'Para poner una portería en tu campo de fútbol... o lo que se te ocurra.', '', '', 'palo_port', '1', 1, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(921, 'Skate', '', '', '', 'patineta', '8', 1, 0, -1, 0, 1500, 0, 0, 'C9B39AB73D90A8DAE011E0E0', '72,72,79,72,72,72,72,72,88,72,72,88', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,0,1,0', '0,0,-1,0,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(922, 'Flotador', 'Para los que se ahogan en un vaso de agua. ;D', '', '', 'pato', '1', 1, 0, -1, 0, 15, 0, 0, 'FEF204E9763A3CC8FE', '72,72,100,72,72,92,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0,-1,0,0,1', '-1,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(923, 'Planta Carnívora', 'Más feroz que un perro guardián.', '', '', 'pcarnivora', '1', 1, 0, -1, 0, 50, 0, 0, '895912256323627F1CFEAF04', '72,72,54,72,72,39,72,72,50,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0', '0,0,0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(924, 'Pelota', '', '', '', 'pelota', '1', 1, 0, -1, 0, 1500, 0, 0, 'E5E3E1', '72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 12, '', '0', 0, 0, -1, NULL, NULL, 0),
(925, 'Fragancia', 'Si', '', '', 'perfume', '7', 1, 0, -1, 0, 2000, 0, 0, 'F96BA6DBB695C3FFFF7FF8FF', '72,72,98,72,72,86,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(926, 'Eau de Chocolat', 'Fragancia deliciosa y dulce como tú ;) Combina vainilla y esencia de Chocoegg.', '', '', 'Perfume_1', '7', 1, 0, -1, 0, 2000, 0, 0, '27FF31CCFF99B7E5B3', '72,72,100,72,72,100,72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 13, '', '0', 0, 0, -1, NULL, NULL, 0),
(927, 'Eau de Lune', 'Fragancia arbolada', '', '', 'Perfume_2', '7', 1, 0, -1, 0, 2000, 0, 0, 'DBFFFC', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 13, '', '0', 0, 0, -1, NULL, NULL, 0),
(928, 'Eau d\'Amiti&#xE9;', 'Fragancia floral fresca y alegre.', '', '', 'Perfume_3', '7', 1, 0, -1, 0, 2000, 0, 0, 'FF514DD8FBFF', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 13, '', '0', 0, 0, -1, NULL, NULL, 0),
(929, 'Eau d\'Amour', 'Fragancia oriental y voluptuosa.', '', '', 'Perfume_4', '7', 1, 0, -1, 0, 2000, 0, 0, 'ABEDB1CEDFE8FFA019FB6E08', '72,72,93,72,72,91,72,72,100,72,72,99', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 13, '', '0', 0, 0, -1, NULL, NULL, 0),
(930, 'Eau Minikong', 'A cualquier cosa le llaman fragancia...', '', '', 'Perfume_5', '7', 1, 0, -1, 0, 2000, 0, 0, 'B6F3FFECEFDB', '72,72,100,72,72,94', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 13, '', '0', 0, 0, -1, NULL, NULL, 0),
(931, 'Perro', 'Leal y divertido. Esperamos que lo disfrutes! (incluye pulgas)', '', '', 'perro', '3', 1, 0, -1, 0, 3000, 0, 0, 'C8B070FE0913', '72,72,79,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 6, '', '0', 0, 0, -1, NULL, NULL, 0),
(932, 'Perry', '', '', '', 'Phineas_Ferb_Navidad', '1', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(933, 'Picnic', 'No lo pierdas de vista', '', '', 'picnic', '2', 1, 0, -1, 0, 200, 0, 0, 'C625104785E74AB12E', '72,72,78,72,72,91,72,72,70', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,1,-1,-1,1,-1,0,-1,1,0', '0,0,1,0,0,-1,1,-1,1,1', '0', -10, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(939, 'Cojin', 'Picnic_Cussion', '', '', 'Picnic_Cussion', '7', 1, 1, 20000, 16000, -1, 0, 0, 'FF8BAE', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(942, 'Pingu Miedoso', 'Hay cosas en esta vida que es mejor no ver.', '', '', 'pingu1', '6', 1, 0, -1, 0, 600, 0, 0, '3B9E9B', '72,72,62', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(943, 'Pingu Coqueto', '¿Se puede ser mas dulce? ¿y mas cursi?', '', '', 'pingu2', '6', 1, 0, -1, 0, 500, 0, 0, 'E5675B', '72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(944, 'Pingu Emperador', 'Siempre lo podras encontrar comiendo o protestando.', '', '', 'pingu3', '6', 1, 0, -1, 0, 600, 0, 0, '58B286', '72,72,70', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(945, 'Pingu Bobo', 'No intentes entender lo que hace.', '', '', 'pingu4', '6', 1, 0, -1, 0, 600, 0, 0, '55C2FF', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(946, 'Pingu Rey', 'Todavía no se ha enterado que no puede volar...', '', '', 'pingu5', '6', 1, 0, -1, 0, 600, 0, 0, '42E236', '72,72,89', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(947, 'Funky', '', '', '', 'pinkAlien', '9', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(948, 'Funky Senior', '', '', '', 'pinkAlienRare', '9', 1, 1, 20000, 16000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(952, 'Esquife Pirata', 'Compra tu esquife pirata y colecciona los 5 nombres!', '', '', 'pirate_boat1', '11', 1, 0, 1000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,2,0,3,0,0,-1,1,-1,2,-1,1,1,2,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(953, 'Charming Mariy', '', '', '', 'pirate_boat2', '11', 0, 0, 1000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,2,0,3,0,0,-1,1,-1,2,-1,1,1,2,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(954, 'Black Pearl', '', '', '', 'pirate_boat3', '11', 0, 0, 1000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,2,0,3,0,0,-1,1,-1,2,-1,1,1,2,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(955, 'Lil Timmy', '', '', '', 'pirate_boat4', '11', 0, 1, 5000, 4000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,2,0,3,0,0,-1,1,-1,2,-1,1,1,2,1', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(956, 'Black Joke', '', '', '', 'pirate_boat5', '11', 0, 1, 2000, 1600, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,2,0,3,0,0,-1,1,-1,2,-1,1,1,2,1', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(957, 'Disgrace', '', '', '', 'pirate_boat6', '11', 0, 0, 1000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,2,0,3,0,0,-1,1,-1,2,-1,1,1,2,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(958, 'Cañón', 'Con diez cañones por banda', '', '', 'pirate_cannon', '11', 1, 0, -1, 0, 1500, 0, 0, 'B59A7FD1DAE2', '72,72,71,72,72,89', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 12, '', '0', 0, 0, -1, NULL, NULL, 0),
(959, 'Cofre del Tesoro', 'Cuidado', '', '', 'pirate_chest', '11', 1, 1, 20000, 16000, -1, 0, 0, 'B28559', '72,72,70', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 11, '', '0', 0, 0, -1, NULL, NULL, 0),
(960, 'Gran Cofre Pirata', '', '', '', 'pirate_chest_large', '11', 1, 1, 50000, 40000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(961, 'Cofre Del Tesoro', '', '', '', 'pirate_chest_medium', '11', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(962, 'Mini Cofre Pirata', '', '', '', 'pirate_chest_small', '11', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(964, 'Bandera Pirata', 'La típica bandera pirata (Jolly Roger)', '', '', 'pirate_flag', '11', 1, 0, -1, 0, 300, 0, 0, 'BAA389C9B4A4DADBD4', '72,72,73,72,72,79,72,72,86', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(965, 'Barco Fantasma', '¡Barco a la vista! ¡Cuidado', '', '', 'pirate_ghost_ship', '11', 1, 0, -1, 0, 4000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(966, 'Sombrero Pirata', 'Para que todos sepan...!quien manda aquí?!!', '', '', 'pirate_hat', '11', 1, 0, -1, 0, 300, 0, 0, '544E56FCFCFC', '72,72,34,72,72,99', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(967, 'Lingotes Oro', '', '', '', 'pirate_ingots', '11', 0, 1, 20000, 16000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,1,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(968, 'Flor del Caribe', '', '', '', 'pirate_jewel1', '11', 0, 1, 20000, 16000, -1, 1, 0, 'FFC06496FFE1', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(969, 'Rubí de Ceilan', '', '', '', 'pirate_jewel2', '11', 0, 1, 20000, 16000, -1, 1, 0, 'E5D1B6FF63EEE8D7A9FFF1FB', '72,72,90,72,72,100,72,72,91,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(970, 'Lámpara de Gas', 'Muy útil para evitar verte sorprendido por malvados bucaneros durante la noche', '', '', 'pirate_lamp', '11', 1, 0, -1, 0, 150, 0, 0, 'C8F9BAFFF5C8', '72,72,98,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(971, 'Willy el tuerto', 'Viejo espía pirata', '', '', 'pirate_monkey1', '11', 1, 0, -1, 0, 1500, 0, 0, 'D1AA88FFF4DF2B789B', '72,72,82,72,72,100,72,72,61', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 12, '', '0', 0, 0, -1, NULL, NULL, 0),
(972, 'Barbas Jack', '¿El parche? Bueno', '', '', 'pirate_monkey2', '11', 1, 0, -1, 0, 1500, 0, 0, 'E0E5C6D7D8D5CCC7B2DBC16A', '72,72,90,72,72,85,72,72,80,72,72,86', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 12, '', '0', 0, 0, -1, NULL, NULL, 0),
(973, 'Capitán Loro', 'Pero...¿quién le ha pedido su opinión?', '', '', 'pirate_parrot', '11', 1, 0, -1, 0, 1000, 0, 0, 'B4CC20C6A28DEA6666F9B581', '72,72,80,72,72,78,72,72,92,72,72,98', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '', '0', 0, 0, -1, NULL, NULL, 0),
(974, 'pirate_platform', 'Descripción', '', 'Si', 'pirate_platform', '11', 1, 0, -1, 0, 500, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(975, 'Botella Pirata', '', '', '', 'pirate_rum', '11', 0, 1, 40000, 32000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(976, 'Terror Errante', 'Tienes espíritu pirata? Pues este es tu barco.', '', '', 'pirate_ship', '11', 1, 0, -1, 0, 3000, 0, 0, 'D1BFAFE0D2C9C1BCBC525653', '72,72,82,72,72,88,72,72,76,72,72,34', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,1,1,2,1,3,0,2,0,1,0,-1,0,-2,1,-2,1,-1,-1,-1,-1,-2,-1,0,-1,1,-1,2,0,3,1,4,1,0,2,3,2,2,2,1,2,0,2,-1', '0,0,1,-1,0,-1,1,-2,0,-2,1,-3,-1,-2,0,-3,0,1,1,0,2,-1,0,2,1,1,2,0,1,2,2,1,1,3,2,2,1,4,2,3', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 2, '', '0', 0, 0, -1, NULL, NULL, 0),
(977, 'Shamsir', '', '', '', 'pirate_sword1', '11', 0, 1, 40000, 32000, -1, 0, 0, 'BEDDDDFFB552A58C601EFBFF', '72,72,87,72,72,100,72,72,65,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(978, 'Sable Pirata', '', '', '', 'pirate_sword2', '11', 0, 1, 20000, 16000, -1, 0, 0, 'C9BFC8FFAA70CEA59D40C97D', '72,72,79,72,72,100,72,72,81,72,72,79', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(979, 'Planeta', 'Genuino y simpático. Rechaza imitaciones', '', '', 'planet_eyes', '9', 1, 1, 20000, 16000, -1, 1, 0, 'FFFA50', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(980, 'Planeta Poblado', '¡Shhh! Dentro están descansando', '', '', 'planet_houses', '9', 1, 1, 20000, 16000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(981, 'Luna', 'Redondita', '', '', 'planet_moon', '9', 1, 1, 100000, 80000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 2, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(982, 'Sol', 'No lo mires fijamente.', '', '', 'planet_sun', '8', 1, 1, 20000, 16000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(983, 'Saturno', '', 'npc', '', 'planeta1', '9', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(984, 'Neptuno', '', 'npc', '', 'planeta2', '9', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(985, 'Marte', '', 'npc', '', 'planeta3', '9', 0, 0, -1, 0, 250, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(986, 'Mercurio', '', 'npc', '', 'planeta4', '9', 0, 0, -1, 0, 250, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(987, 'Júpiter', '', 'npc', '', 'planeta5', '9', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(988, 'La Tierra', '', 'npc', '', 'planeta6', '9', 0, 0, -1, 0, 250, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(989, 'Venus', '', 'npc', '', 'planeta7', '9', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(990, 'Urano', '', 'npc', '', 'planeta8', '9', 0, 0, -1, 0, 250, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(991, 'Planetario', 'Vuestro sistema solar a escala', '', '', 'planetarium', '8', 1, 1, 20000, 16000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1035, 'Regalo Confetti', 'Para celebrar a lo grande!', 'pocion', '', 'Pocima_Gift_Confeti', '8', 0, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 16, 60, 0),
(1036, 'Regalo Halo', 'A que he sido bueno', 'pocion', '', 'Pocima_Gift_Halo', '8', 0, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 17, 180, 0),
(1037, 'Regalo Helicóptero', 'Todo lo que sube acaba bajando', 'pocion', '', 'Pocima_Gift_Helicopter', '8', 0, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 18, 60, 0),
(1038, 'Regalo Laser', 'A veces un punch no es suficiente', 'pocion', '', 'Pocima_Gift_Lightsaber', '8', 0, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 19, 60, 0),
(1039, 'Regalo Avión', 'Díselo y que todos se enteren!', 'pocion', '', 'Pocima_Gift_Plane', '8', 0, 1, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1040, 'Regalo Cohete', 'Prende la mecha.. y corre', 'pocion', '', 'Pocima_Gift_Rocket', '8', 0, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 21, 60, 0),
(1041, 'Regalo Nieve', 'Haz un muñeco de nieve!', 'pocion', '', 'Pocima_Gift_Snowman', '8', 1, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 22, 60, 0),
(1042, 'Regalo Tanque', 'Ponte a cubierto', 'pocion', '', 'Pocima_Gift_Tank', '8', 0, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 23, 60, 0),
(1053, 'Arbol PSU', '', '', '', 'PSU_ArbolLibros', '1', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '-1,-1,0,-1,1,-1,-1,0,0,0,1,0,2,0,-2,1,0,1,1,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1054, 'Binocular', '', '', '', 'PSU_Binoculars', '1', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1055, 'Botato', '', '', '', 'PSU_Boot', '1', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1056, 'Placa', '', '', '', 'PSU_DogTags', '1', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', -500, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1057, 'Muro', '', '', '', 'PSU_Face', '1', 0, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '-1,-1,0,-1,-1,0,0,0,1,0,-1,1,0,1,1,1,-1,2,0,2,1,2,-1,3,0,3,1,3', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1058, 'Bandera', '', '', '', 'PSU_Flag', '1', 0, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,1,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1059, 'Casco', '', 'concurso', '', 'PSU_Helmet', '17³12', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1060, 'Laptop PSU', '', '', '', 'PSU_Laptop', '1', 0, 0, 0, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1061, 'Tienda', '', '', '', 'PSU_Tent', '1', 0, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '-2,-3,-2,-2,-1,-2,-2,-1,-1,-1,0,-1,-2,0,-1,0,0,0,1,0,-2,1,-1,1,0,1,1,1,2,1,-2,2,-1,2,0,2,1,2,2,2,3,2', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1062, 'Totem PSU', '', '', '', 'PSU_Totem', '4', 0, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1063, 'Torre', '', '', '', 'PSU_Tower', '1', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '-1,-2,0,-2,1,-2,2,-2,-1,-1,0,-1,1,-1,2,-1,-1,0,0,0,1,0,2,0,-1,1,0,1,1,1,2,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1064, 'Cantimplora', '', 'concurso', '', 'PSU_Water', '17³12', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1068, 'Calabaza Boba', 'Sus ojos irradian un leve fulgor ante la cercanía de personas malignas', '', '', 'pumpkin1', '4', 1, 0, -1, 0, 25, 0, 0, 'FE941C51BE4B', '72,72,100,72,72,75', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(1069, 'Calabaza mala', 'Sus ojos irradian un leve fulgor ante la cercanía de personas malignas', '', '', 'pumpkin2', '4', 1, 0, -1, 0, 50, 0, 0, 'FE941C51BE4B', '72,72,100,72,72,75', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(1070, 'Guante Bronce', '', 'Trofeo', '', 'punchBronce', '17', 0, 1, 10000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1071, 'Guante Oro', '', 'Trofeo', '', 'punchOro', '17', 0, 1, 30000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1072, 'Guante Plata', '', 'Trofeo', '', 'punchPlata', '17', 0, 1, 20000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1073, 'Quasimodo', 'Está jorobado y hace muecas raras... pero terminarás queriéndolo.', '', '', 'quasimodo', '4', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0);
INSERT INTO `objetos` (`id`, `titulo`, `descripcion`, `Especial`, `colores_mal`, `swf`, `categoria`, `visible`, `visible_mod`, `precio_oro`, `oro_descuento`, `precio_plata`, `vip`, `espacio_mapabytes`, `colores_hex`, `colores_rgb`, `parte_1`, `parte_2`, `parte_3`, `parte_4`, `tam_p`, `tam_n`, `espacio_ocupado_n`, `espacio_2_0`, `tam_g`, `something_4`, `something_5`, `something_6`, `arrastrable`, `salas_usables`, `intercambiable`, `tipo_rare`, `rotacion`, `tipo_arrastre`, `Definicion`, `default_data`, `limitado`, `ofertas`, `precio_anterior`, `efecto_id`, `tiempo_pocion`, `img`) VALUES
(1074, 'Radio', 'Sintoniza tu emisora favorita... ¡si encuentras cobertura!', '', '', 'radio', '1', 1, 0, -1, 0, 100, 0, 0, 'D6CCD5FF6F6FBDE5D3D1BE8D', '72,72,84,72,72,100,72,72,90,72,72,82', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 12, '', '0', 0, 0, -1, NULL, NULL, 0),
(1075, 'Regalo  Mil Caras', 'Regalo del Abeto de las Mil Caras.', '', '', 'regalo_arbol', '8', 0, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1076, 'Choco-Regalo', 'Resiste la tentación de comértelo antes de Pascuas o no podrás abrirlo! Contiene un objeto exclusivo', '', '', 'Regalo_Pascuas', '7', 0, 0, -1, 0, 5000, 0, 0, 'E81F4AFFF99F', '72,72,91,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 11, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1077, 'Regalo', 'Regálaselo a esa persona tan especial! Podrá abrirlo el dia de San Valentín.', '', '', 'Regalo_Valentin', '7', 0, 0, -1, 0, 5000, 0, 0, 'F7899FFF1622', '72,72,97,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '1,-1,1,0,1,1,0,-1,0,0,0,1,-1,-1,-1,0,-1,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 11, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1078, 'Detector Robots', 'Con su increíble descarga eléctrica te podrás atrapar todos los robots que detecte.', 'npc', '', 'robot_detector', '9', 0, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1079, 'Detector Robots', '', 'npc', '', 'robot_detector_bola', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1,1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1080, 'Detector Robots', '', 'npc', '', 'robot_detector_bola_rare', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1,1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1081, 'Detector Robots', '', 'npc', '', 'robot_detector_cupula', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1,1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1082, 'Detector Robots', '', 'npc', '', 'robot_detector_cupula_rare', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1,1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1083, 'Detector Robots', '', 'npc', '', 'robot_detector_gemelos', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1,1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1084, 'Detector Robots', '', 'npc', '', 'robot_detector_gemelos_rare', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1,1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1085, 'Detector Robots', '', 'npc', '', 'robot_detector_peque', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1,1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1086, 'Detector Robots', '', 'npc', '', 'robot_detector_peque_rare', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1,1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1087, 'Detector Robots', '', 'npc', '', 'robot_detector_ruedas', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1,1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1088, 'Detector Robots', '', 'npc', '', 'robot_detector_ruedas_rare', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1,1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1089, '8PS-VRARE', '', '', '', 'robotBola_rare', '9', 1, 1, 20000, 16000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1090, 'QK2', '', '', '', 'robotCupula', '9', 1, 0, -1, 0, 20000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,0,-1,1,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1091, 'QK2-VRARE', '', '', '', 'robotCupula_rare', '9', 1, 1, 20000, 16000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1092, 'HOOVES', '', '', '', 'robotGemelos', '9', 1, 0, -1, 0, 20000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1093, 'HOOVES-VRARE', '', '', '', 'robotGemelos_rare', '9', 1, 1, 20000, 16000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1094, 'Diptera', '', '', '', 'robotPeque', '9', 1, 0, -1, 0, 20000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,0,-1,1,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1095, 'Diptera-VRARE', '', '', '', 'robotPeque_rare', '9', 1, 1, 20000, 16000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1096, 'D.R.T.T', '', '', '', 'robotRuedas', '9', 1, 0, -1, 0, 20000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1097, 'D.R.T.T-VRARE', '', '', '', 'robotRuedas_rare', '9', 1, 0, -1, 0, 5000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,0,0,1', '0,0,0,-1,1,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1098, 'Dios Maya', 'En su honor se han celebrado innumerables sacrificios que te pondrían los pelos de punta.', '', '', 'rock', '5', 1, 0, -1, 0, 600, 0, 0, 'AF7B40259D1D', '72,72,69,72,72,62', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,0,-1,-1,0,-1,1,0,1,-1', '0,0,-1,0,-2,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1099, 'Piedra del Amor', 'Señal de amor grabada en piedra', '', '', 'rock_valentine', '7', 1, 0, -1, 0, 50, 0, 0, 'BBC9D8FFE9F5', '72,72,85,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '0.5', '', '0,0,0,0,0,1,1,1,-1,-1,1,0,-1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1100, 'Cohetes 2', 'Directo a la Luna', '', '', 'rocket', '7', 1, 0, -1, 0, 600, 0, 0, '97AACEFF162CE04A53A6B0D3', '72,72,81,72,72,100,72,72,88,72,72,83', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 12, '', '0', 0, 0, -1, NULL, NULL, 0),
(1101, 'Cohetes 1', 'Directo a la Luna', '', '', 'rocket2', '7', 1, 0, -1, 0, 600, 0, 0, 'B7FFF8E8BA2A83E067FFD88F', '72,72,100,72,72,91,72,72,88,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 12, '', '0', 0, 0, -1, NULL, NULL, 0),
(1102, 'Tendedero', 'Incluye los gayumbos de Ini y Jose (programadores del chat)', '', '', 'ropa', '1', 1, 0, -1, 0, 50, 0, 0, '0E9D00A3DCFEFEA009', '72,72,62,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '-1,-1,1,1', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1103, 'Rosas', 'Preciosas!', '', '', 'rosas', '7', 1, 1, 20000, 16000, -1, 0, 0, '7CA1AFB90608', '72,72,69,72,72,73', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1104, 'Rosa Pequeña', 'Preciosa', '', '', 'rose', '7', 1, 0, -1, 0, 10, 0, 0, 'A5DD94DAD4DB9AAA24F25F62', '72,72,87,72,72,86,72,72,67,72,72,95', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1105, 'Rosa Grande', 'Preciosa', '', '', 'rose_big', '7', 1, 0, -1, 0, 10000, 0, 0, 'BBCE29D7DBD5ACB717FF617A', '72,72,81,72,72,86,72,72,72,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 12, '', '0', 0, 0, -1, NULL, NULL, 0),
(1106, 'Rosa', 'Una tormenta de rosas llegó a BB en San Valentín 2012. ¿Puedes creerlo?', '', '', 'rose_static', '7', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1107, 'Rosa roja', '', '', '', 'rose1', '7', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1108, 'Rosa rosa', '', '', '', 'rose2', '7', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1109, 'Rosa azul', '', '', '', 'rose3', '7', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1110, 'Rosa negra', '', '', '', 'rose4', '7', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1111, 'Rosa blanca', '', '', '', 'rose5', '7', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1112, 'Saco Oro', 'Este saco contiene exactamente 1000 monedas de oro', '', '', 'sacoMonedas', '8', 0, 0, 1000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1113, 'Saco Plata', 'Saco de 1000 monedas de plata', '', '', 'sacoMonedasPla', '8', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1115, 'Ave del paraíso', 'Si es del paraíso', '', '', 'SanValentin_BirdOfParadise', '7', 1, 0, -1, 0, 500, 0, 0, '84DAEDFFDB3DAEFF13FF8771', '72,72,93,72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1116, 'Bombones Corazón', 'El regalo más dulce', '', '', 'SanValentin_Chocolates', '7', 1, 0, -1, 0, 100, 0, 0, 'CC2251FF3F83', '72,72,80,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1117, 'Puff Corazón', '', '', '', 'SanValentin_Couch01', '7', 1, 0, -1, 0, 500, 1, 0, 'F2D09466EBFFA31D6D', '72,72,95,72,72,100,72,72,64', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,0,1,-1,1,1,1,-1,-1,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1118, 'Cupido malvado', '¡Ojo! tira flechas aunque no sea para enamorar', '', '', 'SanValentin_Devil', '7', 1, 0, -1, 0, 1500, 0, 0, 'D6C4ADFF1B2DFFD0AFC9A999', '72,72,84,72,72,100,72,72,100,72,72,79', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1119, 'Lámpara del amor', 'Enciéndela', '', '', 'SanValentin_Heart_Light', '7', 1, 0, -1, 0, 50, 0, 0, 'FFD498FF63A7', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '-1,-1', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1120, 'Llave S. Valentin', 'Abre la puerta de tu habitación.', 'npc', '', 'SanValentin_Key', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1121, 'Llave S. Valentin 1', '', 'npc', '', 'SanValentin_KeyPart1', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1122, 'Llave S. Valentin 2', '', 'npc', '', 'SanValentin_KeyPart2', '17', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1124, 'Ariel', 'Te hipnotizará tocando su arpa al son de las olas.', '', '', 'SanValentin_Mermaid', '7', 1, 0, -1, 0, 1500, 0, 0, 'EA8FE7FFABAF78E2FFFFDAC0', '72,72,92,72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,1,0,0,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(1126, 'Monito simpático', '¡Habla con señas!', '', '', 'SanValentin_Monkey', '7', 1, 0, -1, 0, 1000, 0, 0, '96654DFFD4BD', '72,72,59,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,0,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1127, 'Regalo sorpresa', '¿Quieres saber qué hay dentro? ¡hay 5 objetos y uno de ellos es rare!', '', '', 'SanValentin_Present', '7', 1, 0, -1, 0, 4000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '-1,0,0,0,1,0,0,1,0,-1,-1,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1136, 'Anillo de compromiso', '', '', '', 'SanValentin_Ring', '7', 1, 1, 50000, 40000, -1, 1, 0, 'FFFAFDE81828DDD0C2FFE7E0', '72,72,100,72,72,91,72,72,87,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,0,1,0,-1', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1137, 'Jarrón con rosas', '¿Piensas declararte? ¡díselo con flores!', '', '', 'SanValentin_Roses', '7', 1, 0, -1, 0, 100, 0, 0, 'F9CB9CFF3028', '72,72,98,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1139, 'Cisnes del amor', '¡Son tan románticos!', '', '', 'SanValentin_Swan', '7', 1, 0, -1, 0, 500, 0, 0, 'F2FBFFFFB338', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,-1,1,1', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(1140, 'Mesa para dos', 'Para invitar al amor de tu vida a cenar', '', '', 'SanValentin_Table', '7', 1, 0, -1, 0, 1000, 0, 0, 'FFD16BFF5CA3FF9DD0E5C16E', '72,72,100,72,72,100,72,72,100,72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1141, 'Oso amoroso', 'Suave y esponjoso', '', '', 'SanValentin_Teddy', '7', 1, 0, -1, 0, 1500, 0, 0, 'A1CBFFFFF4D5FFF3FEFFCAD6', '72,72,100,72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1142, 'Árbol Maldito', 'Este árbol pone los pelos de punta a los aventureros más audaces', '', '', 'scarytree', '4', 1, 0, -1, 0, 1000, 0, 0, 'CBAC931393204F4E51D78231', '72,72,80,72,72,58,72,72,32,72,72,85', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,1,1,0,0,-1,1,-1,2,0', '0,0,1,0,0,-1,1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(1143, 'Sepulcro', 'Ideal para crear una atmósfera electrizante y terrorífica', '', '', 'shrine', '4', 1, 0, -1, 0, 75, 0, 0, '6F80A0F1C48E', '72,72,63,72,72,95', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1144, 'Estrella Bronce', '', 'Trofeo', '', 'shurikenBronce', '17', 0, 1, 10000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1145, 'Estrella Oro', '', 'Trofeo', '', 'shurikenOro', '17', 0, 1, 30000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1146, 'Estrella Plata', '', 'Trofeo', '', 'shurikenPlata', '17', 0, 1, 20000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1147, 'Cartel Se Vende', 'Ponlo junto a tus objetos en venta. Podrás añadir una frase de texto con descripción.', '', '', 'Sign_ForSale', '1', 1, 0, -1, 0, 400, 0, 0, 'FF7D1452AEFF3AFF66', '72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '', 'En este cartel no hay nada escrito, no te parece raro?', 0, 0, -1, NULL, NULL, 0),
(1148, 'Sign_ForSale_eng', 'Descripción', '', 'Si', 'Sign_ForSale_eng', '1', 1, 0, -1, 0, 400, 1, 0, 'DD7919689DFF41A846', '72,72,87,72,72,100,72,72,66', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 2, '', '0', 0, 0, -1, NULL, NULL, 0),
(1149, 'Señal Juego', 'Te gustan las flores locas y otros juegos? Este es tu cartel!', '', '', 'Sign_Game', '1', 1, 0, -1, 0, 400, 0, 0, 'DD7919689DFF41A846', '72,72,87,72,72,100,72,72,66', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '', 'En este cartel no hay nada escrito, no te parece raro?', 0, 0, -1, NULL, NULL, 0),
(1150, 'Señal Enamorad@', 'Talla un mensaje para tu enamorad@ aquí. Tranquil@', '', '', 'Sign_Heart', '1', 1, 0, -1, 0, 400, 0, 0, 'DD7919689DFF41A846', '72,72,87,72,72,100,72,72,66', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '', 'En este cartel no hay nada escrito, no te parece raro?', 0, 0, -1, NULL, NULL, 0),
(1151, 'Señal Piraña', 'Si no es seguro darse un baño en tu isla', '', '', 'Sign_Piranha', '1', 1, 0, -1, 0, 400, 0, 0, 'DD7919689DFF41A846', '72,72,87,72,72,100,72,72,66', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '', 'En este cartel no hay nada escrito, no te parece raro?', 0, 0, -1, NULL, NULL, 0),
(1152, 'Señal Peligro', 'Explica que peligros acechan a los incautos que visiten tu isla!', '', '', 'Sign_Skull', '1', 1, 0, -1, 0, 400, 0, 0, 'DD7919689DFF41A846', '72,72,87,72,72,100,72,72,66', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 3, '', 'En este cartel no hay nada escrito, no te parece raro?', 0, 0, -1, NULL, NULL, 0),
(1153, 'Skate Colacao', 'Skate_Colacao', '', '', 'Skate_Colacao', '8', 1, 0, -1, 0, 200, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1154, 'Patines', '', '', '', 'skates', '8', 1, 0, -1, 0, 1500, 0, 0, 'C9C0A89E837DE09E2BBCAF6E', '72,72,79,72,72,62,72,72,88,72,72,74', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1155, 'Pollo esqueleto', '', '', '', 'skeletonChicken', '4', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1156, 'Perro esqueleto', '', '', '', 'skeletonDog', '4', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1157, 'Conejo Esqueleto', '', '', '', 'SkeletonRabbit', '4', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1159, 'Snow Pingu', 'Una tabla para los auténticos  fans de estos desgarbados animalitos', '', '', 'snowboard1', '6', 1, 0, -1, 0, 600, 0, 0, 'FA7A0D5B7EA5', '72,72,99,72,72,65', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1160, 'Snowbuuuzzz', 'Viene con cera de abeja natural ultradeslizante...', '', '', 'snowboard2', '6', 1, 0, -1, 0, 600, 0, 0, 'E5A21E2B282AC49B8D', '72,72,90,72,72,17,72,72,77', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1161, 'Snow Hawai', 'Pero ¿en Hawai hay nieve?', '', '', 'snowboard3', '6', 1, 0, -1, 0, 250, 0, 0, 'D639AA41AFBCD349A8', '72,72,84,72,72,74,72,72,83', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(1162, 'Muñeco de nieve', 'Consíguelo antes de que se funda!', '', '', 'snowman', '6', 1, 0, -1, 0, 500, 0, 0, '1EC335FE5395FEA52950E761', '72,72,77,72,72,100,72,72,100,72,72,91', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0,1,0,0,-1', '0,0,0,0,1,0,0,-1,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1163, 'sock1', 'Descripción', '', 'Si', 'sock1', '8', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1164, 'sock2', 'Descripción', '', 'Si', 'sock2', '8', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1171, 'El Sol', '', '', '', 'sol', '1', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1172, 'Traje Espacial', 'Experimenta la gravedad 0', '', '', 'space_suit', '9', 0, 0, -1, 0, 2000, 0, 0, 'B7C7CEAAB6BFB2D6A3A9ABAF', '72,72,81,72,72,75,72,72,84,72,72,69', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,-1', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 14, '', '0', 0, 0, -1, NULL, NULL, 0),
(1174, 'Venom', '¿Qué es eso que cuelga de tu pantalla? ¡Quiere entrar en tu casa!', '', '', 'spider', '4', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1175, 'Una planta rara', 'No es una araña verde... es una planta ejjej', '', '', 'spider_plant', '2', 1, 0, -1, 0, 10, 0, 0, '28901A', '72,72,57', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1176, 'Estrella', '', '', '', 'star', '1', 1, 0, -1, 0, 300000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,1,-1,0', '-1,0,0,0,1,0,-1,-1', '0', 0, 0, 0, '1', '1³0', 1, 5, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1180, 'Estatua Choco Empollon', '', 'Trofeo', '', 'statue_big_2_s', '15', 1, 1, 100000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1191, 'Estatua Choco Mafioso', '', 'Trofeo', '', 'statue_big_8_e', '15', 1, 1, 100000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1194, 'Estatua Choco India', '', 'Trofeo', '', 'statue_big_9_s', '15', 1, 1, 100000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1195, 'Estatua Choco Rasta', '', 'Trofeo', '', 'statue_big_10_e', '15', 1, 1, 100000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1196, 'Estatua Choco Seta', '', 'Trofeo', '', 'statue_big_10_s', '15', 1, 1, 100000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1197, 'Estatua Choco Gata', '', 'Trofeo', '', 'statue_big_11_s', '15', 1, 1, 100000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1198, 'Choco Premio EMPOLLON', '', 'Trofeo', '', 'statue_small_1', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1199, 'Choco Premio VIEJA', '', 'Trofeo', '', 'statue_small_2', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1200, 'Choco Premio RASTA', '', 'Trofeo', '', 'statue_small_3', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1201, 'Choco Premio VIEJO', '', 'Trofeo', '', 'statue_small_4', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1202, 'Choco Premio INDIA', '', 'Trofeo', '', 'statue_small_5', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1203, 'Choco Premio MAFIOSO', '', 'Trofeo', '', 'statue_small_6', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1204, 'Choco Premio SETA', '', 'Trofeo', '', 'statue_small_7', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1205, 'Choco Premio GATA', '', 'Trofeo', '', 'statue_small_8', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1206, 'Choco Premio ROQUERO', '', 'Trofeo', '', 'statue_small_9', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1207, 'Choco Premio DJ', '', 'Trofeo', '', 'statue_small_10', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1208, 'Choco Premio Bruja', '', 'Trofeo', '', 'statue_small_11', '15', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1209, 'Gnomos de jardin', 'La piedra tallarás y un nuevo amigo encontrarás... :0 Hay cinco diferentes.', '', '', 'stoneBox', '7', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,0,1,-1,1,-1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,-1,1,-1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1210, 'Suitcase_Sharpay', 'Descripción', '', '', 'Suitcase_Sharpay', '7', 1, 0, -1, 0, 200, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1211, 'Grefusa Board', 'Surf Board', '', '', 'Surf_Board', '1', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1212, 'Caja de Pandora', 'No te atrevas a abrirla.', '', '', 'surpriseBoxHalloween', '4', 0, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '1,-1,0,-1,-1,-1,-1,0,0,0,1,0,1,1,0,1,-1,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1213, 'tablon', 'Descripción', '', 'Si', 'tablon', '1', 1, 0, -1, 0, 400, 1, 0, 'DD7919689DFF41A846', '72,72,87,72,72,100,72,72,66', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 2, '', '0', 0, 0, -1, NULL, NULL, 0),
(1214, 'Osito', 'Un osito de trapo: no habla ni camina... ¡pero es tan moooono!', '', '', 'teddy', '8', 1, 0, -1, 0, 15, 0, 0, 'AF7B40', '72,72,69', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1215, 'Sharm', '', '', '', 'teethAlien', '9', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1216, 'Sharm Senior', '', '', '', 'teethAlienRare', '9', 1, 1, 20000, 16000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1217, 'Pasaje del Amor', 'Incluye 2 árboles mágicos. ¡Entrega uno a alguien para conectar vuestras islas! Recuerda: solo se pu', '', '', 'Teleport_Vale', '7', 1, 0, -1, 0, 4000, 0, 0, 'FFE3F0E2FFC9FF3F65', '72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,0,-2,-1,-1,-2,0,-1,-1,1,-2,-2', '0,0,0,-1,0,1,-1,-2,-1,0,-1,1,-2,-2,-2,-1,-2,1,0,-2,-1,-1', '0', 30, 0, 0, '1', '1³0', 1, 0, 1, 22, '', '0', 0, 1, -100, NULL, NULL, 0),
(1219, 'Tomatera', 'Del huerto a tus playas: y ahora', '', '', 'tomato', '1', 1, 0, -1, 0, 100, 0, 0, 'AF5B1FFE2204079819', '72,72,69,72,72,100,72,72,60', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1220, 'Cocodrilo', 'Una gran escultura de césped para tu jardín.', '', '', 'topiary_crocodile', '1', 1, 0, -1, 0, 5000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1221, 'Dragón', 'Una gran escultura de césped para tu jardín.', '', '', 'topiary_dragon', '1', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1222, 'Elefante', 'Una gran escultura de césped para tu jardín.', '', '', 'topiary_elephant', '1', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1223, 'Jirafa', 'Una gran escultura de césped para tu jardín.', '', '', 'topiary_giraffe', '1', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1224, 'LLama', 'Una gran escultura de césped para tu jardín.', '', '', 'topiary_llama', '1', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1225, 'Caracol', 'Una gran escultura de césped para tu jardín.', '', '', 'topiary_slug', '1', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1226, 'Topo', 'Este topo', '', '', 'topo', '2', 1, 0, -1, 0, 500, 0, 0, '565423E79718036D0F', '72,72,34,72,72,91,72,72,43', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 5, '', '0', 0, 0, -1, NULL, NULL, 0),
(1227, 'Caparazón', 'No sirve para nada', '', '', 'tortuga', '1', 1, 0, -1, 0, 25, 0, 0, '346F2F', '72,72,44', 'parte_1', '-1', '-1', '-1', '0', '1', '0,0,0,-1,1,0,1,1', '0,0,0,0,0,-1,1,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1228, 'Tótem', 'Un amuleto imprescindible para ahuyentar los malos espíritus', '', '', 'totem', '1', 0, 0, -1, 0, 1000, 0, 0, '9A6403FE3606FEFEFE868686', '72,72,61,72,72,100,72,72,100,72,72,53', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1229, 'Trampa coco', 'Cuidado con los cocos', '', '', 'Trampa_Coco', '2', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1230, 'Liana', 'Enreda y atrapa a tus amigos.', '', '', 'Trampa_Liana', '2', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', -100, 0, -100, '1', '1³0', 1, 0, 1, 19, '', '0', 0, 0, -1, NULL, NULL, 0),
(1233, 'Sakura', 'En el antiguo Japón se creía que dentro de los Sakura (cerezos) vivían los dioses...¿te lo crees?', '', '', 'tree_blossom', '2', 1, 0, -1, 0, 1500, 0, 0, 'FFA2ADF2E6ECC6BBAD3AB53B', '72,72,100,72,72,95,72,72,78,72,72,71', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(1234, 'Ulmus', 'Hay arboles que dan frutos muy raros...', '', '', 'tree_house', '2', 1, 0, -1, 0, 1500, 0, 0, 'A37D58A1E24EC19F85FF7686', '72,72,64,72,72,89,72,72,76,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,-1,1,1,-1,0,0,1,1,0,0,-1,-2,0,0,2', '0,0,1,0,0,1,1,1,2,1,0,-1,-1,0,-1,-1,-1,-2', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(1235, 'Árbol de Sombra', 'Quien tuviese una maza y una escalera...', '', '', 'tree_mangrove', '2', 1, 0, -1, 0, 1000, 0, 0, 'D1AA88C9FF94A88359', '72,72,82,72,72,100,72,72,66', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,-1,1,1,0,-1,1,0', '0,0,0,-1,-1,-1,-1,0,1,0,1,1,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(1236, 'Sauce Llorón', 'Las ideas mas románticas emergen cuando te quedas embobado mirando la silueta de este mágico arbol..', '', '', 'tree_willow', '2', 1, 0, -1, 0, 1500, 0, 0, 'B2C473D3987A', '72,72,77,72,72,83', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,-1,1,1,-1,0,-2,0,-2,-1,-2,-2,-1,-2,0,-2,1,0,2,0,2,1,1,2,0,3,-1,1,0,-1,1,-1,0,1,0,2,-3,-1,-3,-2,1,3', '0,0,1,-1,1,-2,0,-1,-1,0,0,-2,-1,-1,-2,0,-1,-2,-2,-1,-1,-3,-2,-2,2,-1,1,0,0,1,2,0,1,1,0,2,3,1,2,2,2,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 0),
(1237, 'Triciclo', '', '', '', 'triciclo1', '8', 1, 0, -1, 0, 1500, 0, 0, '9DD1F7A89DAAFFD296', '72,72,97,72,72,67,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,0,-2', '0,0,0,-1,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1238, 'Trofeo Bronce Isla', '', 'Trofeo', '', 'Trofeo_BIsla', '1', 1, 1, 10000, 8000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1239, 'Minitrofeo Bronce Isla', '', 'Trofeo', '', 'Trofeo_bsIsla', '1', 1, 1, 10000, 8000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1240, 'Minitrofeo Bronze', '', 'Trofeo', '', 'Trofeo_Cupidob', '7', 1, 1, 10000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1241, 'Trofeo Bronze', '', 'Trofeo', '', 'Trofeo_CupidobB', '7', 1, 1, 10000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1242, 'Minitrofeo Oro Cupido', '', 'Trofeo', '', 'Trofeo_Cupidog', '7', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1243, 'Trofeo Oro Cupido', '', 'Trofeo', '', 'Trofeo_CupidogB', '7', 1, 1, 50000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1244, 'Minitrofeo Plata Cupido', '', 'Trofeo', '', 'Trofeo_Cupidos', '7', 1, 1, 25000, 20000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1245, 'Trofeo Plata Cupido', '', 'Trofeo', '', 'Trofeo_CupidosB', '7', 1, 1, 25000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1246, 'Trofeo Oro Isla', '', 'Trofeo', '', 'Trofeo_GIsla', '1', 1, 1, 50000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1247, 'Minitrofeo Oro Isla', '', 'Trofeo', '', 'Trofeo_gsIsla', '1', 1, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1251, 'Trofeo Plata Isla', '', 'Trofeo', '', 'Trofeo_SIsla', '1', 1, 1, 25000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1252, 'Minitrofeo Plata Isla', '', 'Trofeo', '', 'Trofeo_ssIsla', '1', 1, 1, 25000, 20000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1253, 'Trompo', '', '', '', 'trompo', '8', 1, 0, -1, 0, 1500, 0, 0, 'F2A053FF3C37', '72,72,95,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 12, '', '0', 0, 0, -1, NULL, NULL, 0),
(1254, 'Tabla de Surf', 'Recién llegada de Hawaii. ¡Cuidado con los tiburones!', '', 'Si', 'tsurf', '1', 1, 0, -1, 0, 500, 0, 0, '7F471309A21D06B5DA', '72,72,50,72,72,64,72,72,86', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1255, 'Tumba', 'La decoración ideal para tu cementerio... o para tu playa!', '', '', 'tumba', '4', 1, 0, -1, 0, 100, 0, 0, '13BE93', '72,72,75', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1257, 'trozo nave 1', '', 'concurso', '', 'Ufo_alien1', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1258, 'trozo nave 2', '', 'concurso', '', 'Ufo_alien2', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1259, 'trozo nave 3', '', 'concurso', '', 'Ufo_alien3', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1260, 'trozo nave 4', '', 'concurso', '', 'Ufo_alien4', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1261, 'trozo nave 5', '', 'concurso', '', 'Ufo_alien5', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1262, 'trozo nave 6', '', 'concurso', '', 'Ufo_alien6', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1263, 'trozo nave 7', '', 'concurso', '', 'Ufo_alien7', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1264, 'trozo nave 8', '', 'concurso', '', 'Ufo_alien8', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1265, 'trozo nave 9', '', 'concurso', '', 'Ufo_alien9', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1266, 'trozo nave 10', '', 'concurso', '', 'Ufo_alien10', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1267, 'trozo nave 11', '', 'concurso', '', 'Ufo_alien11', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1268, 'trozo nave 12', '', 'concurso', '', 'Ufo_alien12', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1269, 'trozo nave 13', '', 'concurso', '', 'Ufo_alien13', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1270, 'trozo nave 14', '', 'concurso', '', 'Ufo_alien14', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1271, 'trozo nave 15', '', 'concurso', '', 'Ufo_alien15', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1272, 'trozo nave 16', '', 'concurso', '', 'Ufo_alien16', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1273, 'trozo nave 17', '', 'concurso', '', 'Ufo_alien17', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1274, 'trozo nave 18', '', 'concurso', '', 'Ufo_alien18', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1275, 'trozo nave 19', '', 'concurso', '', 'Ufo_alien19', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1276, 'trozo nave 20', '', 'concurso', '', 'Ufo_alien20', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1277, 'trozo nave 21', '', 'concurso', '', 'Ufo_alien21', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1278, 'trozo nave 22', '', 'concurso', '', 'Ufo_alien22', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1279, 'trozo nave 23', '', 'concurso', '', 'Ufo_alien23', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1280, 'trozo nave 24', '', 'concurso', '', 'Ufo_alien24', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1281, 'trozo nave 25', '', 'concurso', '', 'Ufo_alien25', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1282, 'trozo nave 26', '', 'concurso', '', 'Ufo_alien26', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1283, 'trozo nave 27', '', 'concurso', '', 'Ufo_alien27', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1284, 'trozo nave 28', '', 'concurso', '', 'Ufo_alien28', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1285, 'trozo nave 29', '', 'concurso', '', 'Ufo_alien29', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1286, 'trozo nave 30', '', 'concurso', '', 'Ufo_alien30', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1287, 'trozo nave 31', '', 'concurso', '', 'Ufo_alien31', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1288, 'trozo nave 32', '', 'concurso', '', 'Ufo_alien32', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1289, 'trozo nave 33', '', 'concurso', '', 'Ufo_alien33', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1290, 'trozo nave 34', '', 'concurso', '', 'Ufo_alien34', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1291, 'trozo nave 35', '', 'concurso', '', 'Ufo_alien35', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1292, 'trozo nave 36', '', 'concurso', '', 'Ufo_alien36', '300', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1293, 'Detector de Ovnis', 'Con su poderosa red podrás atrapar todos los ovnis que detecte', '', '', 'ufo_detector', '9', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,0,-1,1,0,0,1,1,1,-1,-1,1,-1,-1,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1294, 'Láser', '', '', '', 'ufo_part_cannon', '300', 1, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0);
INSERT INTO `objetos` (`id`, `titulo`, `descripcion`, `Especial`, `colores_mal`, `swf`, `categoria`, `visible`, `visible_mod`, `precio_oro`, `oro_descuento`, `precio_plata`, `vip`, `espacio_mapabytes`, `colores_hex`, `colores_rgb`, `parte_1`, `parte_2`, `parte_3`, `parte_4`, `tam_p`, `tam_n`, `espacio_ocupado_n`, `espacio_2_0`, `tam_g`, `something_4`, `something_5`, `something_6`, `arrastrable`, `salas_usables`, `intercambiable`, `tipo_rare`, `rotacion`, `tipo_arrastre`, `Definicion`, `default_data`, `limitado`, `ofertas`, `precio_anterior`, `efecto_id`, `tiempo_pocion`, `img`) VALUES
(1295, 'Panel de Control 1', '', '', '', 'ufo_part_dashboard_1', '300', 1, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1296, 'Panel de Control 2', '', '', '', 'ufo_part_dashboard_2', '300', 1, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1297, 'Cúpula', '', '', '', 'ufo_part_dome', '300', 1, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1298, 'Tren de Aterrizaje', '', '', '', 'ufo_part_ladders', '300', 1, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1299, 'Luz', '', '', '', 'ufo_part_light', '300', 1, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1300, 'Roach', '', '', '', 'uglyAlien', '9', 1, 0, -1, 0, 10000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1301, 'Roach Senior', '', '', '', 'uglyAlienRare', '9', 1, 1, 20000, 16000, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1303, 'Muñeco Vudú', 'Desata los poderes de la magia vudú y podrás poseer a tus amigos (¡o enemigos!)', '', '', 'voodoo_doll', '4', 1, 0, -1, 0, 4000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,0,1,-1,0', '0,0,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 34, '', '0', 0, 0, -1, NULL, NULL, 0),
(1304, 'Lord Vudú', 'Un Lord único en su especie.', '', '', 'voodoo_lord', '4', 1, 1, 50000, 40000, -1, 0, 0, '5CE7FF', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,1', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1305, 'Noria', '', '', '', 'Vuelta_Mundo', '8', 0, 1, 50000, 40000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,-1,-2,-2,-2,-1,-2,0,-2,1,-3,0,-1,0,1,1,2,2,3,1,4,1,4,0,4,-1,3,-1,2,-2,1,-3,0,-4,0,-3,-1,-3,-1,-2,0,-1,1,0,2,1,3,0,2,-1,1,-2', '-2,-2,-1,-2,-3,-1,-2,-1,-1,-1,0,-1,-3,0,-2,0,-1,0,0,0,1,0,-2,1,-1,1,0,1,1,1,2,1,-1,2,0,2,1,2,2,2,0,3', '0', 0, 0, 0, '1', '1³0', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1306, 'Calabaza Inquieta', 'Asegúrate de que tu isla esté bien cerrada cuando ella esté dentro.', '', '', 'walkingPumpkin', '4', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1310, 'Trofeo Hombre Lobo [NPC]', 'Ítem requerido: x50 Dentadura Zombie\" Busca Dentadura Zombie en área \'Cementerio\'\"', 'Trofeo', '', 'werewolf_statue', '4', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1311, 'WerewolfPotion', 'Descripción', 'pocion', '', 'WerewolfPotion', '300', 1, 1, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1313, 'Turbo Witch', '¿Es un pájaro? ¿Un avión? Es la bruja más rápida del Cementerio.', '', '', 'witch', '4', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1314, 'Pelota de Madera', 'Premio de consolación para el concurso Fútbol 2012.', 'Trofeo', '', 'wood_ball', '1', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1315, 'Espumillón', 'El inconfundible y encantador espumillón navideño. No te defraudará.', '', '', 'xmas_espumillon', '1', 1, 0, -1, 0, 600, 0, 0, 'EBFFA4FF4549', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 10, '', '0', 0, 0, -1, NULL, NULL, 0),
(1316, 'Luces de Navidad', 'Ilumina tu isla con una sinfonía de color y luz.', '', '', 'xmas_lights', '1', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1317, 'Abeto Mil Caras', 'El árbol de Navidad más expresivo te ha preparado un regalo especial que podrás abrir el 25/12.', '', '', 'xmas_tree', '6', 1, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,0,1,1,1,-1,1,-1,-1,0,-1,1,0', '-1,-1,-1,0,0,0,-1,1,0,1,1,1', '0', 0, 0, 0, '1', '1³0', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1318, 'Guirnalda', 'Da gusto verla', '', '', 'xmas_wreath', '1', 1, 0, -1, 0, 600, 0, 0, 'FF563EB6FFB5', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 10, '', '0', 0, 0, -1, NULL, NULL, 0),
(1319, 'Cartel Yingo', '', '', '', 'yingo', '300', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0.7', '1', '0,0', '0,0,0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1320, 'Zona Yingo', '¿Populais o Modelais?', '', '', 'yingo_club', '300', 1, 0, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1321, 'Globo Yingo', 'Que todo el mundo sepa que eres fan de Yingo!', '', '', 'yingoBallon', '300', 1, 0, -1, 0, 500, 0, 0, 'FF8D7A72FFC4EAD0AF', '72,72,100,72,72,100,72,72,92', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 8, '', '0', 0, 0, -1, NULL, NULL, 0),
(1322, 'Volantín Exclusivo', 'Consigue tu Volantín Oficial Yingo! En BoomBang podrás disfrutar de él tanto si llueve como si no', '', '', 'yingoKite1', '8', 1, 0, -1, 0, 1000, 0, 0, '7AB4F2B5A6D8D699C3E89AA0', '72,72,95,72,72,85,72,72,84,72,72,91', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0,-1,0,-2,0', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 8, '', '0', 0, 0, -1, NULL, NULL, 0),
(1323, 'Volantín Yingo', 'Original Volantín de Yingo creado específicamente para BoomBang.', '', 'Si', 'yingoKite2', '8', 1, 0, -1, 0, 500, 0, 0, '85B8FC79FFACF4AEBB35C46F', '72,72,99,72,72,100,72,72,96,72,72,77', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '1,1,0,0,0,-1', '', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 8, '', '0', 0, 0, -1, NULL, NULL, 0),
(1324, 'Acuario', 'Urano está de tu parte si naciste entre el 20 de enero y el 19 de febrero.', '', '', 'zodiac_aquarius', '14', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1325, 'Aries', 'Es una cabra', '', '', 'zodiac_aries', '14', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1326, 'Cáncer', 'Te dice la predicción si naciste entre el 21 de junio y el 22 de julio.', '', '', 'zodiac_cancer', '14', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '1,-1,0,-1,0,0,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1327, 'Capricornio', 'Tu talismán si naciste entre el 22 de diciembre y el 19 de enero.', '', '', 'zodiac_capricorn', '14', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,0,-1,1,0,1,-1', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1328, 'Escorpio', 'No tengas miedo', '', '', 'zodiac_escorpi', '14', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,0,-1,1,0,1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1329, 'Géminis', 'Los gemelos juguetones te darán suerte si naciste entre el 21 de mayo y el 20 de junio.', '', '', 'zodiac_geminis', '14', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,-1,1,1', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1330, 'Leo', 'El león más fiero del universo. Predice tu futuro si naciste entre el 23 de julio y el 22 de agosto.', '', '', 'zodiac_leo', '14', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,0,-1,1,0,0,0,0,-1,1,0,1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1331, 'Libra', 'Mantiene en equilibrio tu isla si naciste entre el 23 de septiembre y el 22 de octubre.', '', '', 'zodiac_libra', '14', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,-1,1,1', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1332, 'Piscis', 'No te los comas', '', '', 'zodiac_piscis', '14', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,1,-1,-1', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1333, 'Sagitario', 'Puedes ver cómo tira flechas si naciste entre el 22 de noviembre y el 21 de diciembre.', '', '', 'zodiac_sagitario', '14', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1334, 'Tauro', 'Este toro predice tu futuro si naciste entre el 21 de abril y el 20 de mayo.', '', '', 'zodiac_taurus', '14', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,0,-1,-1,0,0,1,-1,-1', '0,0,0,1,-1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1335, 'Virgo', 'Invita a la diosa Virgo a tu isla si naciste entre el 23 de agosto y el 22 de septiembre.', '', '', 'zodiac_virgo', '14', 1, 0, -1, 0, 2000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1336, 'Trofeo Zombie [NPC]', 'Ítem requerido: x50 Corazón\" Busca Corazón en área \'Cementerio\'\"', 'Trofeo', '', 'zombie_statue', '4', 0, 1, -1, 0, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(1769, 'Alfombra VIP', 'Ambienta tu habitación', '', '', 'alfombra_vip', '16', 1, 0, -1, 0, 1200, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', -50, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1770, 'Bañera', '', '', '', 'bathtub', '16', 1, 0, -1, 0, 100, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,-1,0,0,1,0', '0', 0, 0, 0, '1', '1³3', 1, 5, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1771, 'Cama de cuento', 'Una princesa merece una cama como esta.', '', '', 'Bed_Canopy', '16', 1, 0, -1, 0, 4000, 0, 0, 'FFD7FBBF8A79FFF5FCB53A91', '72,72,100,72,72,75,72,72,100,72,72,71', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,-1,0,-1,1,0,1,1,0,1', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1772, 'Cuna', 'Si te lanzan una poción de diminuto puede resultarte útil', '', '', 'Bed_Crib', '16', 1, 0, -1, 0, 100, 0, 0, 'F6BFFFFF9BF4FFF82254E8FF', '72,72,100,72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1773, 'Cama Oriental', 'Si sueñas con convertirte algún dia en samurai', '', '', 'Bed_Japanese', '16', 1, 0, -1, 0, 4000, 0, 0, 'A580513E3E3FFFF6F6BF1810', '72,72,65,72,72,25,72,72,100,72,72,75', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,-1,0,-1,1,0,0,1,1,1', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1774, 'Cama antigua', 'Incluye un colchón duro y unos muelles ruidosos', '', '', 'Bed_Old', '16', 1, 0, -1, 0, 200, 0, 0, 'FFDBFCDD6499FFF3FED7FF23', '72,72,100,72,72,87,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,-1,1,1,-1,0,0,1,1,0,0,-1', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1775, 'Cama Rústica', '', '', '', 'Bed_wood_simple', '16', 1, 0, -1, 0, 200, 0, 0, 'FFD78384FF235B9ED8FFF8F8', '72,72,100,72,72,100,72,72,85,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,1,-1,0,-1,-1,1,0', '0,0,-1,-1,1,1,1,0,0,-1,-1,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1776, 'Candy', 'Tienes 2 opciones: comerte todas las golosinas tú solo e ir al dentista o compartirlas con tus amigo', '', '', 'Candy_Dispenser', '16', 1, 0, -1, 0, 500, 0, 0, 'FF3028FF3A3A44FF34', '72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1777, 'casa_avion', 'Descripción', '', 'Si', 'casa_avion', '16', 1, 0, -1, 0, 200, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(1778, 'Cesta Ropa', 'Sabemos que sueles dejar tirada la ropa por toda la casa', '', '', 'Casa_Basket', '16', 1, 0, -1, 0, 200, 0, 0, 'F9D692BEFFFCD6B895', '72,72,98,72,72,100,72,72,84', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1779, 'Baby Bat', '', '', '', 'Casa_Bat', '16', 1, 0, -1, 0, 2500, 1, 0, '7A675F87796E6F8C79847474', '72,72,48,72,72,53,72,72,55,72,72,52', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1780, 'Caja Fuerte', '', '', '', 'casa_cajafuerte', '16', 1, 0, -1, 0, 100, 1, 0, 'FCFEF1FF92C9', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 5, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(1781, 'Candelabro', '', '', '', 'Casa_Candelabra', '16', 1, 1, 20000, 16000, -1, 0, 0, '6B5F5E4C4744', '72,72,42,72,72,30', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 4, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1782, 'casa_candies', 'Descripción', '', 'Si', 'casa_candies', '16', 1, 0, -1, 0, 200, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(1783, 'Kayak', 'Silencioso', '', '', 'casa_canoa1', '1', 1, 0, -1, 0, 200, 0, 0, 'FF973DAEFFF7CEA698', '72,72,100,72,72,100,72,72,81', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,0,1,0', '0,0,-1,0,0,-1,1,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1784, 'Kayak', 'Silencioso', '', '', 'casa_canoa2', '1', 1, 0, -1, 0, 200, 0, 0, 'ABFFDFB3FF67FFB240BAAD94', '72,72,100,72,72,100,72,72,100,72,72,73', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,0,1,0', '0,0,-1,0,0,-1,1,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1785, 'casa_carpet', 'Descripción', '', 'Si', 'casa_carpet', '16', 1, 0, -1, 0, 200, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(1786, 'Casco de Rugby', '', '', 'Si', 'casa_cascorugby', '16', 1, 0, -1, 0, 200, 0, 0, '000000F13B0E', '72,72,0,72,72,95', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1787, 'casa_chair', 'Descripción', '', '', 'casa_chair', '16', 1, 0, -1, 0, 200, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(1788, 'Silla Vampiro', '', '', '', 'Casa_Chair_09', '16', 1, 0, -1, 0, 300, 0, 0, '8E8074CC6040', '72,72,56,72,72,80', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1789, 'Maleta de Viaje', 'Imprescindible para emprender cualquier aventura. Siempre lista con tus objetos más preciados!', '', '', 'Casa_Chest', '16', 1, 0, -1, 0, 500, 0, 0, '875A2AFFFFFFEADFDFFFCB98', '72,72,53,72,72,100,72,72,92,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1790, 'casa_coat_rack', 'Descripción', '', 'Si', 'casa_coat_rack', '16', 1, 0, -1, 0, 200, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(1791, 'Cama Ataúd', '', '', '', 'Casa_Coffin', '16', 1, 0, -1, 0, 350, 0, 0, 'DD447F60595FC4B66E', '72,72,87,72,72,38,72,72,77', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,0,1,1,1,-1,-1', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1792, 'Cofre', '', '', 'Si', 'casa_cofre', '16', 1, 0, -1, 0, 200, 0, 0, 'B28941FFEB3B', '72,72,70,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(1793, 'casa_comoda', 'Descripción', '', 'Si', 'casa_comoda', '16', 1, 0, -1, 0, 200, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(1794, 'En Construcción', 'Ponlo en tu isla o casita para señalizar y advertir a tus visitantes.', '', '', 'casa_cono', '16', 1, 0, -1, 0, 250, 0, 0, 'FF3617F7FFFB', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(1795, 'Bola de Cristal', '', '', '', 'Casa_Crystal_Ball', '16', 1, 0, -1, 0, 5000, 1, 0, '443D3A91484F', '72,72,27,72,72,57', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1796, 'Escultura VIP', '', '', '', 'Casa_Deco_Moon', '16', 1, 0, -1, 0, 250, 1, 0, 'FFF5FCFFF41C', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 5, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1797, 'Nube de Azúcar', 'Una dulce escultura hecha con algodón de azúcar', '', '', 'Casa_Deco_Moon_Cloud03', '16', 1, 0, -1, 0, 200, 0, 0, 'FFF5FCCCFFFC', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1798, 'Mesa de DJ', 'Saca el DJ que llevas dentro.', '', '', 'casa_discos', '16', 1, 0, -1, 0, 1000, 0, 0, '894738BA3630', '72,72,54,72,72,73', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(1799, 'Cajonera', 'Una práctica cajonera para guardar tus cosas.', '', '', 'Casa_Drawers', '16', 1, 0, -1, 0, 500, 0, 0, 'FFAF1DF8FFB5D6BF8C', '72,72,100,72,72,100,72,72,84', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,-1,0,0,-1', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1800, 'Batería', 'La más cotizada entre los inconformistas.', '', 'Si', 'casa_drumbs', '16', 1, 0, -1, 0, 1500, 0, 0, 'E8F4E384482BFFEE61FFE55E', '72,72,96,72,72,52,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,0,1,0,-1', '0,0,1,-1,1,0,1,-2,0,-1', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(1801, 'Duende de Jardín', '', '', '', 'casa_duende', '16', 1, 0, -1, 0, 200, 0, 0, 'D5D87FEBFFFBD8653AF42B2A', '72,72,85,72,72,100,72,72,85,72,72,96', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1802, 'Tumba Egipcia', '', '', '', 'Casa_Egyptian_Coffin', '16', 1, 0, -1, 0, 12500, 1, 0, '53775BC67F345E5452106466', '72,72,47,72,72,78,72,72,37,72,72,40', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,0,0,1', '0,0,1,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1803, 'casa_fighter', 'Descripción', '', '', 'casa_fighter', '16', 1, 0, -1, 0, 300, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(1804, 'Nevera Hambrienta', '', '', '', 'Casa_Fridge01', '16', 1, 0, -1, 0, 2500, 1, 0, '164C2E7AAF9BA0895D', '72,72,30,72,72,69,72,72,63', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1805, 'Consola Portátil', '', '', '', 'casa_game', '16', 1, 0, -1, 0, 300, 0, 0, 'efecf767646ff73a41', '72,72,97,72,72,44,72,72,97', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(1806, 'Jarrones', 'Contienen guijarros y sirven para decorar los rincones de tu casa', '', '', 'casa_jarron1', '16', 1, 0, -1, 0, 200, 0, 0, 'C6EA7BEAD29F', '72,72,92,72,72,92', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1807, 'Jarrón', '', '', '', 'casa_jarron2', '16', 1, 0, -1, 0, 250, 0, 0, 'FC2727000000', '72,72,99,72,72,0', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(1808, 'Jet Ski', 'Serás la sensación de la playa. ¡Prohibido subir sin chaleco!', '', '', 'casa_jetski', '1', 1, 0, -1, 0, 600, 0, 0, 'B7FFE2D5B7FFFFD77696CFFF', '72,72,100,72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,0,1,0', '0,0,-1,0,0,-1,1,-1,1,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1809, 'casa_lamp_foot', 'Descripción', '', 'Si', 'casa_lamp_foot', '16', 1, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(1810, 'Lamparilla', '', '', '', 'casa_lampara', '16', 1, 0, -1, 0, 100, 0, 0, 'FFE747FFE945', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(1811, 'Gran Biblioteca', 'Gran Biblioteca', '', '', 'Casa_Library', '16', 1, 1, 20000, 16000, -1, 1, 0, '473F33FF8C1DF9D475EFCC4E', '72,72,28,72,72,100,72,72,98,72,72,94', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³3', 1, 4, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1812, 'Armario Jekyll', '', '', '', 'Casa_Library02', '16', 1, 0, -1, 0, 12500, 1, 0, '564F44FFC823FFCA14', '72,72,34,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1813, 'Kit Maquillaje', 'A quien no le gusta ponerse guapa para recibir a sus invitados?', '', '', 'Casa_MakupTable', '16', 1, 0, -1, 0, 2000, 0, 0, 'FF83A2C8C8FFFFF0F7FFF7FA', '72,72,100,72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,1,0,0,-1', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1814, 'Felpudo', 'Haz pasar a tus visitas por él antes de entrar en tu habitación!', '', '', 'Casa_Mat', '16', 1, 0, -1, 0, 5, 0, 0, 'FFFAFDDBBD99', '72,72,100,72,72,86', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', -500, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1815, 'casa_mesaratona', 'Descripción', '', '', 'casa_mesaratona', '16', 1, 0, -1, 0, 250, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(1816, 'Mini Cooper', '', '', '', 'casa_minicooper', '16', 1, 0, -1, 0, 300, 0, 0, 'E54254', '72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(1817, 'Espejo de Cuento', '', '', '', 'Casa_Mirror01', '16', 1, 0, -1, 0, 5000, 1, 0, '967D53BA9755', '72,72,59,72,72,73', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1818, 'Piano', 'Para los amantes de la música', '', 'Si', 'casa_piano', '16', 1, 0, -1, 0, 1500, 0, 0, 'FF301AB2281E', '72,72,100,72,72,70', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,0,1,1,1,1,0,2,0,2,1', '0,0,1,-1,2,-2,2,-1,0,-1,0,-2,1,-2,1,0', '0', -30, 0, 0, '1', '1³3', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(1819, 'Planetario', 'Relájate soñando con otros mundos.', '', '', 'casa_planetas', '16', 1, 0, -1, 0, 1000, 0, 0, '000000EDFFFBDBFFEA6CC6E0', '72,72,0,72,72,100,72,72,100,72,72,88', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(1820, 'casa_ropero', 'Descripción', '', 'Si', 'casa_ropero', '16', 1, 0, -1, 0, 250, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(1821, 'casa_small_lamp', 'Descripción', '', 'Si', 'casa_small_lamp', '16', 1, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(1822, 'Cajonera Mini', 'Un complemento perfecto para tu salón o habitación', '', '', 'Casa_SmallTable01', '16', 1, 0, -1, 0, 10, 0, 0, 'FFBB2EFF9E21', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1823, 'Mesita baja', 'Para apoyar los pies o decorar pequeñas habitaciones', '', '', 'Casa_SmallTable02', '16', 1, 0, -1, 0, 15, 0, 0, 'FFE0A34ED3E8', '72,72,100,72,72,91', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1824, 'Mesita Versalles', '', '', '', 'Casa_SmallTable03', '16', 1, 0, -1, 0, 100, 1, 0, 'BA9F897A5B99', '72,72,73,72,72,60', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³3', 1, 5, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1825, 'casa_sofa', 'Descripción', '', 'Si', 'casa_sofa', '16', 1, 0, -1, 0, 500, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(1826, 'Altavoz Hi-Fi', '', '', '', 'Casa_Speaker', '16', 1, 0, -1, 0, 4000, 1, 0, 'F9FFFF', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 5, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1827, 'Altavoz de Diseño', 'Inalámbricos', '', '', 'casa_speaker1', '16', 1, 0, -1, 0, 1500, 0, 0, 'FF9B4DF7FFF4', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(1828, 'Altavoz de Diseño', 'Inalámbricos', '', '', 'casa_speaker2', '16', 1, 0, -1, 0, 1000, 0, 0, 'FF9B4DF7FFF4', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(1829, 'Hornillo', '', '', '', 'Casa_StoveRobot', '16', 1, 0, -1, 0, 2500, 1, 0, 'BED8C6DD7F4D8C7D72', '72,72,85,72,72,87,72,72,55', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,0,-1,1,0,-1,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1830, 'Mesa de Roble', 'Una noble mesa para tu salón', '', '', 'Casa_Table01', '16', 1, 0, -1, 0, 1000, 0, 0, 'FAF6FFFF4E35', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '-1,-1,-1,0,0,0,1,1,2,1,2,0,1,0,1,-1,0,-1,-1,-2', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1831, 'Mesa Kawaii', 'Una mesita adorable que te hará sonreir incluso los días lluviosos', '', '', 'Casa_Table02', '16', 1, 0, -1, 0, 2000, 0, 0, 'FCC7ECA57C56968B79', '72,72,99,72,72,65,72,72,59', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0,1,1,-1,-1,-1,0', '-1,-1,0,-1,0,0,1,0,1,1', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1832, 'Mesita Alta', '', '', '', 'Casa_Tall_Table', '16', 1, 0, -1, 0, 250, 0, 0, '846C51C5FC0E', '72,72,52,72,72,99', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1833, 'Cubo de Basura', 'Mantener limpia tu casa nunca fue tan cute.', '', '', 'casa_trashbin', '16', 1, 0, -1, 0, 250, 0, 0, 'FFFCF2797973FFB487E8A478', '72,72,100,72,72,48,72,72,100,72,72,91', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(1834, 'TV de Vanguardia', 'La TV del futuro. Sintoniza 1000 canales de todos los rincones  del universo.', '', '', 'casa_tv', '16', 1, 0, -1, 0, 300, 0, 0, 'F45B5EE22D36FFB8C1CFD7DB', '72,72,96,72,72,89,72,72,100,72,72,86', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(1835, 'Paraguas', '', '', '', 'Casa_Umbrellas', '16', 1, 0, -1, 0, 250, 0, 0, 'FFFE156FFF2359473E7112BF', '72,72,100,72,72,100,72,72,35,72,72,75', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1836, 'Máquina Agua', 'Deberás compartir el agua con el pez que vive adentro!', '', '', 'Casa_Water_Cooler', '16', 1, 0, -1, 0, 500, 0, 0, 'FFA91A', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1837, 'Silla Artesanal', 'Una artesanal silla tallada a mano.', '', '', 'Chair_01', '16', 1, 0, -1, 0, 200, 0, 0, '6B6A5C80E8FF', '72,72,42,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1838, 'Silla Madera', '', '', '', 'Chair_04', '16', 1, 0, -1, 0, 250, 0, 0, 'F9D28D', '72,72,98', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1839, 'Silla sencilla', 'Una funcional silla sin más pretensiones', '', '', 'Chair_05', '16', 1, 0, -1, 0, 5, 0, 0, 'FEFFFCFFF330', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1840, 'Silla de Cuento', 'En esta silla de cuento podrás soñar con los ojos abiertos', '', '', 'Chair_06', '16', 1, 0, -1, 0, 400, 0, 0, 'F9F3FFFF9FD4', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1841, 'Banqueta', 'Simple y funcional', '', '', 'Chair_07', '16', 1, 0, -1, 0, 200, 0, 0, 'FDFBFFFF3649', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1842, 'Cama Moderna', 'Funcional pero con personalidad.', '', '', 'casa_cama', '16', 1, 0, -1, 0, 500, 0, 0, 'C49C9CC8F7FC9CAA679DC649', '72,72,77,72,72,99,72,72,67,72,72,78', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,1,0,1,1,0,1', '0,0,1,-1,1,0,2,0,1,1,0,1,0,-1', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 9, '', '0', 0, 0, -1, NULL, NULL, 1),
(1843, 'Mecedora', '', '', '', 'Christmas_Chair', '16', 1, 0, -1, 0, 250, 0, 0, 'FFDCA6AD7D57C4FF40FF7C30', '72,72,100,72,72,68,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1844, 'Casita de muñecas', 'Una exquisita casita de muñecas', '', '', 'Christmas_DollHouse', '16', 1, 0, -1, 0, 1500, 0, 0, 'FFBFE7F4D7FFFFCEECE89D56', '72,72,100,72,72,100,72,72,100,72,72,91', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,1,0,-1,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1845, 'Armario Laponia', 'Elaborado con madera de Laponia', '', '', 'Christmas_Wardrobe', '16', 1, 0, -1, 0, 1000, 0, 0, 'E9FFA5FF7779FF252EFFF81F', '72,72,100,72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1846, 'Máquina de Café', '', '', '', 'coffee_machine', '16', 1, 0, -1, 0, 500, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,-1,1,-1,0,0,1,0', '0', 0, 0, 0, '1', '1³3', 1, 5, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(1847, 'Consola Juegos', '', '', '', 'Consola_Member_Marzo', '16', 1, 0, -1, 0, 250, 1, 0, 'BD95D1C0EBFF9DE259FFF9D3', '72,72,82,72,72,100,72,72,89,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 5, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1848, 'DJ', '', '', '', 'dj', '16', 1, 0, -1, 0, 500, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,0,-1,1,-1,1,0', '0', 0, 0, 0, '1', '1³3', 1, 5, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(1849, 'Cama de madriguera', '', '', '', 'Easter_Bed', '16', 1, 0, -1, 0, 1000, 0, 0, 'FFDC1DFF702EFFD0A0C9FF1E', '72,72,100,72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,-1,-1,0,0,1,1,1,1,2,1,0', '0,0,-1,0,0,1,1,1,-1,-1,0,-1,1,0,1,-1', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1850, 'Silla alada', 'Ella vuela a donde te quieras sentar', '', '', 'Easter_Chair', '16', 1, 0, -1, 0, 500, 0, 0, 'FFDC33FFF729BDE529', '72,72,100,72,72,100,72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1851, 'Nevera inestable', '', '', '', 'Easter_Fridge', '16', 1, 0, -1, 0, 500, 0, 0, 'FFED1E4BC2FFFFF835', '72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1852, 'Regalo Pascuas', '¡Sorpresa! ¿cuál de los cinco posibles objetos te tocará?', '', '', 'Easter_Present_1', '16', 0, 0, -1, 0, 3000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(1853, 'Regalo de Pascuas', '¡Sorpresa! ¿cuál de los cinco posibles objetos te tocará?', '', '', 'Easter_Present_2', '16', 0, 0, -1, 0, 200, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(1854, 'Robot Webb-o', 'Nacido en el 2080', '', '', 'Easter_Robot', '16', 1, 0, -1, 0, 500, 0, 0, 'F4FF31D8CED3FFF03666F3FF', '72,72,100,72,72,85,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1855, 'Mesita del té', '¡Con una gran tarta para merendar!', '', '', 'Easter_Table', '16', 1, 0, -1, 0, 500, 0, 0, 'FFE8D2F9FFFFFFD730FFB427', '72,72,100,72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,0,-1,1,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1856, 'HiFi', '', '', '', 'HiFi_Member_Mayo', '16', 1, 0, -1, 0, 250, 1, 0, 'F9F3F35B585BFF3649', '72,72,98,72,72,36,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 5, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1857, 'Máquina de Helados', '', '', '', 'ice_cream_machine', '16', 1, 0, -1, 0, 250, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 5, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(1858, 'Hi Fi', '100%% cobertura garantizada en BoomBang!', '', '', 'IPod', '16', 1, 0, -1, 0, 50, 0, 0, 'F7F4FF14F3FF17F3FFFE8EFE', '72,72,100,72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1859, 'Lámpara rústica', 'Una agradable lámpara con base de madera tallada a mano', '', '', 'Lamp_01', '16', 1, 0, -1, 0, 20, 0, 0, 'F3DAFFFD8BFF', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1860, 'Lampara Diseño', 'Una lámpara de diseño para tu casita.', '', '', 'Lamp_04', '16', 1, 0, -1, 0, 400, 0, 0, 'FFF7FAE2FF39FCF2FF', '72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1861, 'Lámpara Diseño', '', '', '', 'Lamp_05', '16', 1, 0, -1, 0, 250, 0, 0, 'FFF3F9DEFF26FDEBFF', '72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1862, 'Lámpara antigua', 'Hallada en el polvoriento baúl de un lejano pariente', '', '', 'Lamp_06', '16', 1, 0, -1, 0, 400, 0, 0, '7F695CD8C293FFECB7FAF6FF', '72,72,50,72,72,85,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1863, 'Globo luminoso', '', '', '', 'Lamp_07', '16', 1, 0, -1, 0, 250, 1, 0, 'D3C9C9B1F8FF', '72,72,83,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 5, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 1),
(1864, 'Lampara de lava', '', '', '', 'lavalamp', '16', 1, 0, -1, 0, 250, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 5, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(1865, 'mesa_chica', 'Descripción', '', '', 'mesa_chica', '16', 1, 0, -1, 0, 250, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1866, 'mesa_grande', 'Descripción', '', 'Si', 'mesa_grande', '16', 1, 0, -1, 0, 500, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1867, 'Máquina Chicles', 'Chicles gigantes rellenos de miedo', '', '', 'Miedo_MaquinaChicle', '16', 1, 0, -1, 0, 2500, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1868, 'Consola BB', 'Imprescindible para gamers', '', '', 'Playstation', '16', 1, 0, -1, 0, 100, 0, 0, 'A7FF3AFEF7FF000000FF3BF0', '72,72,100,72,72,100,72,72,0,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1869, 'Mesa de Billar', '', '', '', 'PoolTable', '16', 1, 0, -1, 0, 2500, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,0,-1,-1,-1,1,0,2,-1,2,1,2,1,1,1,-1,0,1,1,0,0,-1', '-1,-1,0,0,-1,0,-1,1,-2,1,-2,2,-1,2,0,2,-1,3,0,3,0,1', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1870, 'Cama corazón', '¡Tendrás dulces y amorosos sueños cada noche!', '', '', 'SanValentin_Bed_Heart', '16', 1, 0, -1, 0, 1000, 0, 0, 'ED4A9B48E8FF66469EF2E672', '72,72,93,72,72,100,72,72,62,72,72,95', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0,-1,-1,-1,0,1,1,0,1,-1,1,1,0,0,-1,1,-1', '-1,0,-1,-1,0,-1,0,1,1,1,1,0,0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1871, 'Mesita de maquillaje', '', '', '', 'SanValentin_MakeupTable02', '16', 1, 0, -1, 0, 250, 0, 0, 'BC4AFF8C32FFAF52FFFFCE70', '72,72,100,72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,-1,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1872, 'Nevera refrescante', '', '', '', 'SanValentin_Minibar', '16', 1, 0, -1, 0, 250, 0, 0, '9562D3FF87FC', '72,72,83,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1873, 'Sofá amoroso', '', '', '', 'SanValentin_Sofa', '16', 1, 0, -1, 0, 500, 0, 0, 'FF36709B329AFF597F', '72,72,100,72,72,61,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,1,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1874, 'Sofa Redondo', 'Lo último en diseño', '', '', 'Sofa_01', '16', 1, 0, -1, 0, 1000, 0, 0, 'FFFFF7DFFF15', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,1,0,0,-1', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1875, 'Sofá Retro', 'Retro y cool', '', '', 'Sofa_02', '16', 1, 0, -1, 0, 1000, 0, 0, '777151FFF49BFFE03F', '72,72,47,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1,-1,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1876, 'Sofa Mullido', 'Un mullido y cómodo sofá sobre el que tumbarte', '', '', 'Sofa_05', '16', 1, 0, -1, 0, 1000, 0, 0, '82D162E8FF74E8FF7E48827C', '72,72,82,72,72,100,72,72,100,72,72,51', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '-1,0,0,0,1,0,0,-1', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1877, 'Sofa Chesterfield', 'Un clásico que nunca pasa de moda', '', '', 'Sofa_06', '16', 1, 0, -1, 0, 500, 0, 0, '7A653BB5E828', '72,72,48,72,72,91', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,-1,1,1,1,0,0,-1,-1,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1878, 'Sofá rectangular', 'Hazte con este sofá a precio de saldo!', '', '', 'Sofa_07', '16', 1, 0, -1, 0, 100, 0, 0, 'FFFDFAFF691EFFFA5029F8FF', '72,72,100,72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,-1,0,0,1,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1879, 'Sofá Terciopelo', 'Un elegante sofá con un diseño exclusivo.', '', '', 'Sofa_08', '16', 1, 0, -1, 0, 1000, 0, 0, '9E8A8D474041FF371A', '72,72,62,72,72,28,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,1,0,-1,0,-1,-1,1,1', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1880, 'Altavoz Inalámbrico', '', '', '', 'Speaker_Member_Abril', '16', 1, 0, -1, 0, 300, 1, 0, 'FAF6FFEF141F', '72,72,100,72,72,94', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 5, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1881, 'TV', 'Televisor de alta definición para ver tus series y pelis favoritas', '', '', 'TV01', '16', 1, 0, -1, 0, 200, 0, 0, 'FFC412F7FFEE', '72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,1,0,0,-1', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1882, 'Máquina de Bebidas', '', '', '', 'vending_machine', '16', 1, 0, -1, 0, 500, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,0,-1,1,-1,1,0', '0', 0, 0, 0, '1', '1³3', 1, 5, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1883, 'Armario Oriental', 'Un amplio armario con cierre para evitar que se cuelen esas molestas polillas.', '', '', 'Wardrobe01', '16', 1, 0, -1, 0, 100, 0, 0, 'C9A464FFD219FFDFAC', '72,72,79,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,1,0,0,-1', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1884, 'Armario de Gala', 'Un precioso armario donde guardar tus vestidos de fiesta', '', '', 'Wardrobe02', '16', 1, 0, -1, 0, 250, 0, 0, 'FFD45DFF1622FF8F239F48A3', '72,72,100,72,72,100,72,72,100,72,72,64', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1885, 'Pozo', 'Si las hadas de su interior están de buenas', '', '', 'well', '1', 1, 1, -1, -1, 1000, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0,1,0,-1,0,0,1,-1,-1,1,-1,2,-1,0,-1', '0', 0, 0, 0, '1', '1³0', 1, 1, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1886, 'Biombo', 'Un delicado biombo tallado a mano para crear ambientes en tu habitación u ocultarte tras él', '', '', 'Windscreen', '16', 1, 0, -1, 0, 150, 0, 0, 'FF1F16FFF221FF771B', '72,72,100,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,-1,1,1,-1,0,1,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 1, '', '0', 0, 0, -1, NULL, NULL, 0),
(1887, 'Shadow Fungus', '¡No comestible!', '', '', 'alien_mushroom_a', '19', 1, 0, 1000, 0, -1, 0, 0, '37F2FF', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(1888, 'Shadow Fungus', '', '', '', 'alien_mushroom_a_final', '19', 0, 0, 1000, 0, -1, 0, 0, '43FFFB', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1889, 'Shadow Fungus', '', '', '', 'alien_mushroom_a_rare', '19', 0, 0, 20000, 0, -1, 0, 0, '43FFFB', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1890, 'Walrus Fungus', '¡Cuidado que muerde!', '', '', 'alien_mushroom_b', '19', 1, 0, 1000, 0, -1, 0, 0, 'F6CCFF', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1891, 'Walrus Fungus', '', '', '', 'alien_mushroom_b_final', '19', 0, 0, 1000, 0, -1, 0, 0, 'F6CCFF', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1892, 'Walrus Fungus', '', '', '', 'alien_mushroom_b_rare', '19', 0, 0, 20000, 0, -1, 0, 0, 'F6CCFF', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1893, 'Rotten Fungus', 'Huele un poco mal...', '', '', 'alien_mushroom_c', '19', 1, 0, 1000, 0, -1, 0, 0, 'B4FFC5', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1894, 'Rotten Fungus', '', '', '', 'alien_mushroom_c_final', '19', 0, 0, 1000, 0, -1, 0, 0, 'B4FFC5', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1895, 'Rotten Fungus', '', '', '', 'alien_mushroom_c_rare', '19', 0, 1, 20000, 16000, -1, 0, 0, 'B4FFC5', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 4, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1896, 'Ungus Fungus', 'Un hongo que se cree pingüino', '', '', 'alien_mushroom_d', '19', 1, 0, 1000, 0, -1, 0, 0, 'FFD374', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1897, 'Ungus Fungus', '', '', '', 'alien_mushroom_d_final', '19', 0, 0, 1000, 0, -1, 0, 0, 'FFD374', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1898, 'Ungus Fungus', '', '', '', 'alien_mushroom_d_rare', '19', 0, 0, 20000, 0, -1, 0, 0, 'FFD374', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1899, 'Zombie Fungus', '¡No comestible!', '', '', 'alien_mushroom_e', '19', 1, 0, 1000, 0, -1, 0, 0, 'FF184E', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1900, 'Zombie Fungus', '', '', '', 'alien_mushroom_e_final', '19', 0, 0, 1000, 0, -1, 0, 0, 'FF184E', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0);
INSERT INTO `objetos` (`id`, `titulo`, `descripcion`, `Especial`, `colores_mal`, `swf`, `categoria`, `visible`, `visible_mod`, `precio_oro`, `oro_descuento`, `precio_plata`, `vip`, `espacio_mapabytes`, `colores_hex`, `colores_rgb`, `parte_1`, `parte_2`, `parte_3`, `parte_4`, `tam_p`, `tam_n`, `espacio_ocupado_n`, `espacio_2_0`, `tam_g`, `something_4`, `something_5`, `something_6`, `arrastrable`, `salas_usables`, `intercambiable`, `tipo_rare`, `rotacion`, `tipo_arrastre`, `Definicion`, `default_data`, `limitado`, `ofertas`, `precio_anterior`, `efecto_id`, `tiempo_pocion`, `img`) VALUES
(1901, 'Zombie Fungus', '', '', '', 'alien_mushroom_e_rare', '19', 0, 1, 20000, 16000, -1, 0, 0, 'FF184E', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 4, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1902, 'Silent Jack', '¿Crees que es solo una planta? Yo en tu lugar vigilaría mis espaldas.', '', '', 'halloweenTree', '19', 1, 0, 1000, 0, -1, 0, 0, 'FFBA33', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 1),
(1903, 'Silent Jack', '¿Crees que es solo una planta? Yo en tu lugar vigilaría mis espaldas.', '', '', 'halloweenTree_Final', '19', 0, 0, 1000, 0, -1, 0, 0, 'FFBA33', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1904, 'Silent Jack', '¿Crees que es solo una planta? Yo en tu lugar vigilaría mis espaldas.', '', '', 'halloweenTree_Rare', '19', 0, 1, 20000, 16000, -1, 0, 0, 'FFBA33', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 4, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1905, 'Rosa del Paraíso', 'Cuando un explorador la encontró en un recóndito rincón', '', '', 'plant_rose_1', '19', 1, 1, 5000, 4000, -1, 0, 0, '95EAE7', '72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1', '0', 0, 0, 0, '1', '1³3', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1906, 'Rosa Exótica', 'Cuando un explorador la encontró en un recóndito rincón', '', '', 'plant_rose_2', '19', 1, 1, 5000, 4000, -1, 0, 0, 'FFA9FF', '72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1', '0', 0, 0, 0, '1', '1³3', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1907, 'Rosa Extraña', 'Cuando un explorador la encontró en un recóndito rincón', '', '', 'plant_rose_3', '19', 1, 1, 5000, 4000, -1, 0, 0, 'F40303', '72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1908, 'Rosa del Paraíso', 'Cuando un explorador la encontró en un recóndito rincón', '', '', 'plant_rose_final_1', '19', 0, 1, 5000, 4000, -1, 0, 0, '92F9F5', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1', '0', 0, 0, 0, '1', '1³3', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1909, 'Rosa Exótica', 'Cuando un explorador la encontró en un recóndito rincón', '', '', 'plant_rose_final_2', '19', 0, 1, 5000, 4000, -1, 0, 0, 'FFB9FF', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,0,-1', '0', 0, 0, 0, '1', '1³3', 1, 3, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1910, 'Rosa Extraña', 'Cuando un explorador la encontró en un recóndito rincón', '', '', 'plant_rose_final_3', '19', 0, 1, 5000, 4000, -1, 0, 0, 'FE9D9D', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1911, 'Champiñón', 'El sombrerón le da sombra', '', '', 'Plantas_BosqueShroom', '19', 1, 0, 1000, 0, -1, 0, 0, 'FFBDBD', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1912, 'Champiñón', 'El sombrerón le da sombra', '', '', 'Plantas_BosqueShroomFinal', '19', 0, 0, 1000, 0, -1, 0, 0, 'FFA0B9', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1913, 'Champiñón', 'El sombrerón le da sombra', '', '', 'Plantas_BosqueShroomRare', '19', 0, 1, 20000, 16000, -1, 0, 0, 'FFC8DD', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 4, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1914, 'Orchis Coloris', 'Señorial y colorida. Atención: ¡es una planta hay que regarla!', '', '', 'Plantas_Butterfly', '19', 1, 0, 1000, 0, -1, 0, 0, 'FF51D0', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1915, 'Orchis Coloris', '', '', '', 'Plantas_Butterfly_Final', '19', 0, 0, 1000, 0, -1, 0, 0, 'FF79DD', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1916, 'Orchis Coloris', '', '', '', 'Plantas_Butterfly_Rare', '19', 0, 1, 20000, 16000, -1, 0, 0, 'FF63EE', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 4, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1917, 'Cowboycactus', 'Se cree que está en el lejano oeste. Atención: ¡es una planta hay que regarla!', '', '', 'Plantas_Cactus', '19', 1, 0, 1000, 0, -1, 0, 0, 'A0FF91', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1918, 'Cowboycactus', '', '', '', 'Plantas_Cactus_Final', '19', 0, 0, 1000, 0, -1, 0, 0, 'BCFFA0', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1919, 'Cowboycactus', '', '', '', 'Plantas_Cactus_Rare', '19', 0, 0, 20000, 0, -1, 0, 0, 'ABFF97', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1920, 'Pasqual', 'Una especie en extinción', '', '', 'Plantas_ChocoBranchBunny', '19', 1, 0, 1000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1921, 'Pasqual', 'Una especia en extinción', '', '', 'Plantas_ChocoBranchBunny_Final', '19', 0, 0, 1000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1922, 'Pasqual', 'Una especia en extinción', '', '', 'Plantas_ChocoBranchBunny_Rare', '19', 0, 1, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 4, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1923, 'Xocobon', 'Lindo bonsai comestible', '', '', 'Plantas_ChocoBunnyTree', '19', 1, 0, 1000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1924, 'Xocobon', 'Lindo bonsai comestible', '', '', 'Plantas_ChocoBunnyTree_Final', '19', 0, 0, 1000, 0, -1, 0, 0, 'FFFA50', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1925, 'Xocobon', 'Lindo bonsai comestible', '', '', 'Plantas_ChocoBunnyTree_Rare', '19', 0, 1, 20000, 16000, -1, 0, 0, 'FFFA50', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 4, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1926, 'Zonorio', 'Seguro que así te gustarán las verduras', '', '', 'Plantas_ChocoCarrot', '19', 1, 0, 1000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1927, 'Zonorio', 'Seguro que así te gustarán las verduras', '', '', 'Plantas_ChocoCarrot_Final', '19', 0, 0, 1000, 0, -1, 0, 0, 'FFFA50', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1928, 'Zonorio', 'Seguro que así te gustarán las verduras', '', '', 'Plantas_ChocoCarrot_Rare', '19', 0, 1, 20000, 16000, -1, 0, 0, 'FFFA50', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 4, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1929, 'Chiribita fucsia', '¡Pequeñita pero llena de felicidad! Atención: ¡es una planta hay que regarla!', '', '', 'Plantas_Daisy', '19', 1, 0, 1000, 0, -1, 0, 0, 'F1F8FF', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1930, 'Chiribita fucsia', '', '', '', 'Plantas_Daisy_Final', '19', 0, 0, 1000, 0, -1, 0, 0, 'FF8A93', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1931, 'Chiribita fucsia', '', '', '', 'Plantas_Daisy_Rare', '19', 0, 0, 20000, 0, -1, 0, 0, 'FF949D', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1932, 'Helix', 'Una planta con muy mal humor. Atención: ¡es una planta hay que regarla!', '', '', 'Plantas_Evil', '19', 1, 0, 1000, 0, -1, 0, 0, 'FFFA50', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1933, 'Helix', '', '', '', 'Plantas_Evil_Final', '19', 0, 0, 1000, 0, -1, 0, 0, '80C0FF', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1934, 'Helix', '', '', '', 'Plantas_Evil_Rare', '19', 0, 1, 20000, 16000, -1, 0, 0, '98CFFF', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 4, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1935, 'Bibipluff', '¿Vegetal o animal?. Atención: ¡es una planta hay que regarla!', '', '', 'Plantas_Lala', '19', 1, 0, 1000, 0, -1, 0, 0, 'FFFA50', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1936, 'Bibipluff', '', '', '', 'Plantas_Lala_Final', '19', 0, 0, 1000, 0, -1, 0, 0, 'E1D7FF', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1937, 'Bibipluff', '', '', '', 'Plantas_Lala_Rare', '19', 0, 1, 20000, 16000, -1, 0, 0, 'E5CCFF', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 4, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1938, 'Bonsai increíble', 'Es pequeño pero es más grande que su maceta. Atención: ¡es una planta hay que regarla!', '', '', 'Plantas_Panda', '19', 1, 0, 1000, 0, -1, 0, 0, 'FFFA50', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1939, 'Bonsai increíble', '', '', '', 'Plantas_Panda_Final', '19', 0, 0, 1000, 0, -1, 0, 0, 'EAE3DC', '72,72,92', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1940, 'Bonsai increíble', '', '', '', 'Plantas_Panda_Rare', '19', 0, 1, 20000, 16000, -1, 0, 0, 'E8DBD3', '72,72,91', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 4, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1941, 'Carnivorus Plantae', '¡Es carnívora de verdad! Atención: ¡es una planta hay que regarla!', '', '', 'Plantas_Pitcher', '19', 1, 0, 1000, 0, -1, 0, 0, 'FFFA50', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1942, 'Carnivorus Plantae', '', '', '', 'Plantas_Pitcher_Final', '19', 0, 0, 1000, 0, -1, 0, 0, 'CBFF91', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1943, 'Carnivorus Plantae', '', '', '', 'Plantas_Pitcher_Rare', '19', 0, 1, 20000, 16000, -1, 0, 0, 'B5E873', '72,72,91', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 4, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1944, 'Girasol Fashion', 'Él también se protege del sol. Atención: ¡es una planta hay que regarla!', '', '', 'Plantas_Sunflower', '19', 1, 0, 1000, 0, -1, 0, 0, '87FF61', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1945, 'Girasol Fashion', '', '', '', 'Plantas_Sunflower_Rare', '19', 0, 1, 1000, 800, -1, 0, 0, 'FFE624', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³3', 1, 4, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1946, 'Hugo el Rey Calabaza', 'Todas las calabazas hacen una reverencia en su presencia.', '', '', 'pumpkin', '19', 1, 0, 1000, 0, -1, 0, 0, 'FFFA50', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1947, 'Hugo el Rey Calabaza', 'Todas las calabazas hacen una reverencia en su presencia.', '', '', 'pumpkin_grown', '19', 0, 0, 1000, 0, -1, 0, 0, 'FF8617', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1948, 'Hugo el Rey Calabaza', 'Todas las calabazas hacen una reverencia en su presencia.', '', '', 'pumpkin_rare', '19', 0, 0, 20000, 0, -1, 0, 0, 'FF9E23', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '1', '1³3', 1, 0, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(1949, 'Ant Tree', '', '', '', 'tree_ants', '19', 1, 0, 5000, 0, -1, 0, 0, 'E5D5CD', '72,72,90', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,0,1,1,0,1,1,2,1,2,2,1,2,0,2,-1,1,-2,0,-1,0,-2,-1,-1,-1,0,-1,-2,1,-1,2,0,3,1,3,-2,-2,-1,-2,0,-2,1', '0', 0, 0, 0, '1', '3³0', 1, 0, 1, 26, '', '0', 0, 0, -1, NULL, NULL, 0),
(1950, 'Ant Tree', '', '', '', 'tree_ants_final', '19', 0, 0, 5000, 0, -1, 0, 0, 'FFF1D6', '72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-2,0,-1,-1,0,-1,1,-1,1,0,0,1,1,1,0,2,1,2', '0', 0, 0, 0, '1', '3³0', 1, 0, 1, 27, '', '0', 0, 0, -1, NULL, NULL, 0),
(3000, 'Regalo VIP', 'Oro    PlataVIP - 1 Mes, 3 Meses, 6 Meses', '', '', 'abb_present', '300', 1, 1, -1, 0, 4, 0, 0, 'FF322D3D107BFFE68CFFFB3C', '72,72,100,72,72,95,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,2,0,0,-1,1,-1,0,-2,-1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 11, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3001, 'Regalo Puntos', 'Si, !nos hemos vuelto locos!; especial coleccionistas.  Disponible solamente durante este mes.', '', '', 'abb_present', '300', 1, 1, -1, 0, 4, 0, 0, 'FF322DFFFFFFFFE68CFFFB3C', '72,72,100,72,72,95,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,2,0,0,-1,1,-1,0,-2,-1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 11, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3002, 'Regalo Objetos', 'Si, !nos hemos vuelto locos!; especial coleccionistas.  Disponible solamente durante este mes.', '', '', 'abb_present', '300', 1, 1, -1, 0, 4, 0, 0, 'FF322Dffce3dFFE68CFFFB3C', '72,72,100,72,72,95,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,2,0,0,-1,1,-1,0,-2,-1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 11, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3003, 'Regalo Universal', 'Si, !nos hemos vuelto locos!; especial coleccionistas.  Disponible solamente durante este mes.', '', '', 'abb_present', '300', 1, 1, -1, 0, 4, 0, 0, 'FF322D91F231FFE68CFFFB3C', '72,72,100,72,72,95,72,72,100,72,72,100', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,1,0,2,0,0,-1,1,-1,0,-2,-1,-1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 11, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3004, 'Efecto Beso', 'Dale un gran beso!', 'pocion', '', 'SanValentin_Regalo_Beso', '7', 1, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 31, 12, 0),
(3005, 'Lluvia de Rosas', 'Para que cubras a tu medida de rosas.', 'pocion', '', 'SanValentin_Regalo_Rosas', '7', 1, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 25, 60, 0),
(3006, 'Cupido Carleone', 'Porque hay amores que matan', 'pocion', '', 'SanValentin_Regalo_Corleone', '7', 1, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 28, 10, 0),
(3007, 'Ojos de enamorado', 'Díselo con tan solo una mirada', 'pocion', '', 'SanValentin_Regalo_Enamorado', '7', 1, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 27, 20, 0),
(3009, 'Pajarito travieso', '¡Sorpresa!', 'pocion', '', 'SanValentin_Regalo_Pajarito1', '7', 1, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 29, 30, 0),
(3010, 'Pajarito mensajero', 'Entrega tu carta de amor', 'pocion', '', 'SanValentin_Regalo_Pajarito2', '7', 1, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 30, '17 Antiguo', '0', 0, 0, -1, 30, 30, 0),
(3011, 'Espectro [VIP]', 'Serás una criatura de ultratumba', 'pocion', '', 'Miedo_Pipeta_Black', '4', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 11, 420, 0),
(3012, 'Murciélago [VIP]', 'Invoca tu mascota nocturna', 'pocion', '', 'Miedo_Pipeta_Brown', '4', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 3, 120, 0),
(3013, 'Apestado [VIP]', 'Nube apestosa que te sigue', 'pocion', '', 'Miedo_Pipeta_Cyan', '4', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 14, 120, 0),
(3014, 'Lengua Trapo [VIP]', 'Su lengua se hinchará y retorcerá', 'pocion', '', 'Miedo_Pipeta_Dark_Blue', '4', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 5, 120, 0),
(3015, 'Sapo [VIP]', 'Croac!', 'pocion', '', 'Miedo_Pipeta_Dark_Green', '4', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 10, 60, 0),
(3016, 'Teleport Master [VIP]', 'Desplazamiento intramolecular', 'pocion', '', 'Miedo_Pipeta_Dark_Red', '4', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 29, '17 Antiguo', '0', 0, 0, -1, 15, 7, 0),
(3017, 'Invisible [VIP]', 'Nadie sabrá que estás ahi!', 'pocion', '', 'Miedo_Pipeta_Light_Blue', '4', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 7, 120, 0),
(3018, 'Acido [VIP]', 'Sólo quedarán sus huesos..', 'pocion', '', 'Miedo_Pipeta_Light_Green', '4', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 13, 60, 0),
(3019, 'Diminuto [VIP]', 'Ser pequeño tiene sus ventajas', 'pocion', '', 'Miedo_Pipeta_Orange', '4', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 2, 120, 0),
(3020, 'Gigante [VIP]', 'El tamaño sí importa!', 'pocion', '', 'Miedo_Pipeta_Purple', '4', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 1, 120, 0),
(3021, '0', 'Descripción', 'pocion', '', 'Miedo_Pipeta_Rose', '4', 0, 1, 25, 0, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3022, 'Inversa [VIP]', 'Para hablar al revés!', 'pocion', '', 'Miedo_Pipeta_Turqoise', '4', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 6, 120, 0),
(3023, 'Mudo [VIP]', 'No podrás articular palabra', 'pocion', '', 'Miedo_Pipeta_Violet', '4', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 4, 120, 0),
(3024, 'Fantasma [VIP]', 'Camina entre los vivos', 'pocion', '', 'Miedo_Pipeta_White', '4', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 12, 420, 0),
(3025, 'Rayo [VIP]', 'Se avecina una tormenta!', 'pocion', '', 'Miedo_Pipeta_Yellow', '4', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 9, 60, 0),
(3026, 'Regalo Confetti [VIP]', 'Para celebrar a lo grande!', 'pocion', '', 'Pocima_Gift_Confeti', '8', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 16, 60, 0),
(3027, 'Regalo Halo [VIP]', 'A que he sido bueno', 'pocion', '', 'Pocima_Gift_Halo', '8', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 17, 180, 0),
(3028, 'Regalo Helicóptero [VIP]', 'Todo lo que sube acaba bajando', 'pocion', '', 'Pocima_Gift_Helicopter', '8', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 18, 60, 0),
(3029, 'Regalo Laser [VIP]', 'A veces un punch no es suficiente', 'pocion', '', 'Pocima_Gift_Lightsaber', '8', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 19, 60, 0),
(3030, 'Regalo Avión [VIP]', 'Díselo y que todos se enteren!', 'pocion', '', 'Pocima_Gift_Plane', '8', 0, 1, 25, 0, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3031, 'Regalo Cohete [VIP]', 'Prende la mecha.. y corre', 'pocion', '', 'Pocima_Gift_Rocket', '8', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 21, 60, 0),
(3032, 'Regalo Nieve [VIP]', 'Haz un muñeco de nieve!', 'pocion', '', 'Pocima_Gift_Snowman', '8', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 22, 60, 0),
(3033, 'Regalo Tanque [VIP]', 'Ponte a cubierto', 'pocion', '', 'Pocima_Gift_Tank', '8', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 23, 60, 0),
(3034, '0', 'Descripción', 'pocion', '', 'WerewolfPotion', '300', 0, 1, 25, 0, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3035, '0', 'Descripción', 'pocion', '', 'ZombiePotion', '300', 0, 1, 25, 0, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3036, 'Lluvia de Rosas [VIP]', 'Para que cubras a tu medida de rosas.', 'pocion', '', 'SanValentin_Regalo_Rosas', '7', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 25, 60, 0),
(3037, 'Cupido Carleone [VIP]', 'Porque hay amores que matan', 'pocion', '', 'SanValentin_Regalo_Corleone', '7', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 28, 10, 0),
(3038, 'Ojos de enamorado [VIP]', 'Díselo con tan solo una mirada', 'pocion', '', 'SanValentin_Regalo_Enamorado', '7', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 27, 20, 0),
(3040, 'Pajarito travieso [VIP]', '¡Sorpresa!', 'pocion', '', 'SanValentin_Regalo_Pajarito1', '7', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 29, 30, 0),
(3041, 'Pajarito mensajero [VIP]', 'Entrega tu carta de amor', 'pocion', '', 'SanValentin_Regalo_Pajarito2', '7', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 30, 30, 0),
(3042, 'Efecto Beso [VIP]', 'Dale un gran beso!', 'pocion', '', 'SanValentin_Regalo_Beso', '7', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 31, 12, 0),
(3043, 'Vender objetos de Oro', 'Habla con Conejo Negociador para vender objetos de Oro. Conseguirás el 50% del precio original.', '', '', 'Sign_Rare', '1', 1, 1, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '0,0', '0,0', '0', 0, 0, 0, '1', '1³0', 0, 0, 0, 26, '', 'En este cartel no hay nada escrito, no te parece raro?', 0, 0, -1, NULL, NULL, 0),
(3044, 'Chat Rosa', 'Usa la placa \"Chat Rosa\" para cambiar el color de tu chat.', '', '', 'Chat_Rosa', '8', 1, 0, 10000, 8000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '0.5', '', '', '0', 0, 0, 0, '0', '', 0, 1, 1, 28, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3045, 'Chat Rojo', 'Usa la placa \"Chat Rojo\" para cambiar el color de tu chat.', '', '', 'Chat_Rojo', '8', 1, 0, 10000, 8000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '0.5', '', '', '0', 0, 0, 0, '0', '', 0, 1, 1, 28, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3046, 'Chat Azul', 'Usa la placa \"Chat Azul\" para cambiar el color de tu chat.', '', '', 'Chat_Azul', '8', 1, 0, 10000, 8000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '0.5', '', '', '0', 0, 0, 0, '0', '', 0, 1, 1, 28, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3047, 'Chat Verde', 'Usa la placa \"Chat Verde\" para cambiar el color de tu chat.', '', '', 'Chat_Verde', '8', 1, 0, 10000, 8000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '0.5', '', '', '0', 0, 0, 0, '0', '', 0, 1, 1, 28, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3048, 'Lluvia de Rosas [NPC]', 'Item requerido: x25 Setas\" Busca Setas en area \'La Madriguera\'\"', 'pocion', '', 'SanValentin_Regalo_Rosas', '7', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 25, 60, 0),
(3049, 'Cupido Carleone [NPC]', 'Item requerido: x25 Setas\" Busca Setas en area \'La Madriguera\'\"', 'pocion', '', 'SanValentin_Regalo_Corleone', '7', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 28, 10, 0),
(3050, 'Ojos de enamorado [NPC]', 'Item requerido: x25 Setas\" Busca Setas en area \'La Madriguera\'\"', 'pocion', '', 'SanValentin_Regalo_Enamorado', '7', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 27, 20, 0),
(3052, 'Pajarito travieso [NPC]', 'Item requerido: x25 Setas\" Busca Setas en area \'La Madriguera\'\"', 'pocion', '', 'SanValentin_Regalo_Pajarito1', '7', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 29, 30, 0),
(3053, 'Pajarito mensajero [NPC]', 'Item requerido: x25 Setas\" Busca Setas en area \'La Madriguera\'\"', 'pocion', '', 'SanValentin_Regalo_Pajarito2', '7', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 30, '17 Antiguo', '0', 0, 0, -1, 30, 30, 0),
(3054, 'Regalo Confetti ', 'Ítem requerido: x25 Bola de nieve\" Busca Bola de nieve en área \'BosqueNevado\'\"', 'pocion', '', 'Pocima_Gift_Confeti', '8', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 16, 60, 0),
(3055, 'Regalo Halo ', 'Ítem requerido: x25 Bola de nieve\" Busca Bola de nieve en área \'BosqueNevado\'\"', 'pocion', '', 'Pocima_Gift_Halo', '8', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 17, 180, 0),
(3056, 'Regalo Helicóptero ', 'Ítem requerido: x25 Bola de nieve\" Busca Bola de nieve en área \'BosqueNevado\'\"', 'pocion', '', 'Pocima_Gift_Helicopter', '8', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 18, 60, 0),
(3057, 'Regalo Laser', 'Ítem requerido: x25 Bola de nieve\" Busca Bola de nieve en área \'BosqueNevado\'\"', 'pocion', '', 'Pocima_Gift_Lightsaber', '8', 0, 0, -1, 0, 100, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 19, 60, 0),
(3058, 'Regalo Avión', 'Ítem requerido: x25 Bola de nieve\" Busca Bola de nieve en área \'BosqueNevado\'\"', 'pocion', '', 'Pocima_Gift_Plane', '8', 0, 1, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3059, 'Regalo Cohete ', 'Ítem requerido: x25 Bola de nieve\" Busca Bola de nieve en área \'BosqueNevado\'\"', 'pocion', '', 'Pocima_Gift_Rocket', '8', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 21, 60, 0),
(3060, 'Regalo Nieve [NPC]', 'Ítem requerido: x25 Bola de nieve\" Busca Bola de nieve en área \'BosqueNevado\'\"', 'pocion', '', 'Pocima_Gift_Snowman', '8', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 22, 60, 0),
(3061, 'Regalo Tanque [NPC]', 'Ítem requerido: x25 Bola de nieve\" Busca Bola de nieve en área \'BosqueNevado\'\"', 'pocion', '', 'Pocima_Gift_Tank', '8', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '0', '', 1, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 23, 60, 0),
(3062, 'Teleport [VIP]', 'Desplazamiento intramolecular', 'pocion', '', 'Miedo_Pipeta_Red', '4', 0, 0, 25, 0, -1, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 8, 7, 0),
(3063, 'Ninja Elite', 'Ninja creado  con la gema Amatista', '', '', 'Ninja_Purpura', '13', 1, 0, -1, -1, 100, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '0.5', '', '', '0', 0, 0, 0, '0', '', 0, 1, 1, 28, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3064, 'Efecto Beso [NPC]', 'Item requerido: x25 Setas\" Busca Setas en area \'La Madriguera\'\" ', 'pocion', '', 'SanValentin_Regalo_Beso', '7', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 31, 12, 0),
(3065, 'Cambio Nombre', 'Teniendo este objeto puedes realizar el cambio de nombre de tu personaje.', '', '', 'nombre', '17', 1, 1, 10000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3066, 'Ninja Oscuro', 'Ninja creado con la gema Zafiro', '', '', 'Ninja_Oscuro', '13', 1, 0, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '0.5', '', '', '0', 0, 0, 0, '0', '', 0, 1, 1, 28, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3067, 'Ninja Rosa', 'Ninja creado con la gema Morganita', '', '', 'Ninja_Rosa', '13', 1, 0, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '0.5', '', '', '0', 0, 0, 0, '0', '', 0, 1, 1, 28, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3068, 'Ninja Verde', 'Ninja creado con la gema Esmeralda', '', '', 'Ninja_Verde', '13', 1, 0, 20000, 16000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '0.5', '', '', '0', 0, 0, 0, '0', '', 0, 1, 1, 28, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3069, 'Ninja Espectrum [LIMITADO]', 'Que tiemblen tus rivales. Conviertete en ninja de tus rivales', '', '', 'Ninja_Blanco', '13', 1, 0, 150000, 120000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '0.5', '', '', '0', 0, 0, 0, '0', '', 0, 1, 1, 28, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3070, 'Espectro', 'Espectro', '', '', 'Ninja_Blanco', '17', 0, 0, 5000, 4000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '0.5', '', '', '0', 0, 0, 0, '0', '', 0, 1, 1, 28, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3071, 'Fantasma', 'Fantasma', '', '', 'Ninja_Blanco', '17', 0, 0, 5000, 4000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '0.5', '', '', '0', 0, 0, 0, '0', '', 0, 1, 1, 28, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3072, 'Halloween Bronce', '', 'Trofeo', '', 'hallobronce', '17', 0, 1, 10000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,1,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3073, 'Halloween Oro', '', 'Trofeo', '', 'hallooro', '17', 0, 1, 50000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,1,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3074, 'Halloween Plata', '', 'Trofeo', '', 'halloplata', '17', 0, 1, 25000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,1,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3075, 'Navidad Bronce', '', 'Trofeo', '', 'navidadbronce', '17', 0, 1, 10000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,1,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3076, 'Navidad Oro', '', 'Trofeo', '', 'navidadoro', '17', 0, 1, 50000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,1,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3077, 'Navidad Plata', '', 'Trofeo', '', 'navidadplata', '17', 0, 1, 25000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,1,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3078, 'Pasqua Bronce', '', 'Trofeo', '', 'pascuabronce', '17', 0, 1, 10000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,1,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3079, 'Pasqua Oro', '', 'Trofeo', '', 'pascuaoro', '17', 0, 1, 50000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,1,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3080, 'Pasqua Plata', '', 'Trofeo', '', 'pascuaplata', '17', 0, 1, 25000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,1,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3081, 'S.Valentin Bronce', '', 'Trofeo', '', 'valentinbronce', '17', 0, 1, 10000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,1,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3082, 'S.Valentin Oro', '', 'Trofeo', '', 'valentinoro', '17', 0, 1, 50000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,1,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3083, 'S.Valentin Plata', '', 'Trofeo', '', 'valentinplata', '17', 0, 1, 25000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0,-1,0,-1,1,0,1', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3084, 'Espectro [NPC]', 'Ítem requerido: x10 Sangre de vampiro\" Busca Sangre de vampiro en área \'Cementerio\'\"', 'pocion', '', 'Miedo_Pipeta_Black', '4', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 11, 420, 0),
(3085, 'Murciélago [NPC]', 'Ítem requerido: x10 Sangre de vampiro\" Busca Sangre de vampiro en área \'Cementerio\'\"', 'pocion', '', 'Miedo_Pipeta_Brown', '4', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 3, 120, 0),
(3086, 'Apestado [NPC]', 'Ítem requerido: x10 Sangre de vampiro\" Busca Sangre de vampiro en área \'Cementerio\'\"', 'pocion', '', 'Miedo_Pipeta_Cyan', '4', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 14, 120, 0),
(3087, 'Lengua Trapo [NPC]', 'Ítem requerido: x10 Sangre aristócrata\" Busca Sangre aristócrata en área \'Cementerio\'\"', 'pocion', '', 'Miedo_Pipeta_Dark_Blue', '4', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 5, 120, 0),
(3088, 'Sapo [NPC]', 'Ítem requerido: x10 Sangre fresca\" Busca Sangre fresca en área \'Cementerio\'\"', 'pocion', '', 'Miedo_Pipeta_Dark_Green', '4', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 10, 60, 0),
(3089, 'Teleport Master [NPC]', 'Ítem requerido: x10 Sangre fresca\" Busca Sangre fresca en área \'Cementerio\'\"', 'pocion', '', 'Miedo_Pipeta_Dark_Red', '4', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 29, '17 Antiguo', '0', 0, 0, -1, 15, 7, 0),
(3090, 'Invisible [NPC]', 'Ítem requerido: x10 Sangre aristócrata\" Busca Sangre aristócrata en área \'Cementerio\'\"', 'pocion', '', 'Miedo_Pipeta_Light_Blue', '4', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 7, 120, 0),
(3091, 'Acido [NPC]', 'Ítem requerido: x10 Sangre de muerto\" Busca Sangre de muerto en área \'Cementerio\'\"', 'pocion', '', 'Miedo_Pipeta_Light_Green', '4', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 13, 60, 0),
(3092, 'Diminuto [NPC]', 'Ítem requerido: x10 Sangre de muerto\" Busca Sangre de muerto en área \'Cementerio\'\"', 'pocion', '', 'Miedo_Pipeta_Orange', '4', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 2, 120, 0),
(3093, 'Gigante [NPC]', 'Ítem requerido: x10 Sangre dulce\" Busca Sangre dulce en área \'Cementerio\'\"', 'pocion', '', 'Miedo_Pipeta_Purple', '4', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 1, 120, 0),
(3094, 'Inversa [NPC]', 'Ítem requerido: x10 Sangre aristócrata\" Busca Sangre aristócrata en área \'Cementerio\'\"', 'pocion', '', 'Miedo_Pipeta_Turqoise', '4', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 6, 120, 0),
(3095, 'Mudo [NPC]', 'Ítem requerido: x10 Sangre dulce\" Busca Sangre dulce en área \'Cementerio\'\"', 'pocion', '', 'Miedo_Pipeta_Violet', '4', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 4, 120, 0),
(3096, 'Fantasma [NPC]', 'Ítem requerido: x10 Ectoplasma\" Busca Ectoplasma en área \'Cementerio\'\"', 'pocion', '', 'Miedo_Pipeta_White', '4', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 12, 420, 0),
(3097, 'Rayo [NPC]', 'Ítem requerido: x10 Sangre de muerto\" Busca Sangre de muerto en área \'Cementerio\'\"', 'pocion', '', 'Miedo_Pipeta_Yellow', '4', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 0, 0, 28, '17 Antiguo', '0', 0, 0, -1, 9, 60, 0),
(3098, 'Teleport [VIP]', 'Desplazamiento intramolecular', 'pocion', '', 'Miedo_Pipeta_Red', '4', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 8, 7, 0),
(3099, 'Teleport [NPC]', 'Ítem requerido: x10 Sangre de muerto\" Busca Sangre de muerto en área \'Cementerio\'\"', 'pocion', '', 'Miedo_Pipeta_Red', '4', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 8, 7, 0),
(3100, 'Guante Oro Hal', '', 'Trofeo', '', 'punchOroHal', '17', 0, 1, 30000, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '0,0', '0', 0, 0, 0, '1', '1³0', 1, 0, 1, 26, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3101, 'Efecto Arcoiris [VIP]', 'Ilumina a tu amor.', 'pocion', '', 'SanValentin_Regalo_ArcoIris', '7', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 26, 20, 0),
(3102, 'Efecto Arcoiris', 'Ilumina a tu amor.', 'pocion', '', 'SanValentin_Regalo_ArcoIris', '7', 1, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 26, 20, 0),
(3103, 'Efecto Arcoiris [NPC]', 'Item requerido: x25 Setas\" Busca Setas en area \'La Madriguera\'\"', 'pocion', '', 'SanValentin_Regalo_ArcoIris', '7', 0, 0, -1, 0, 100, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 26, 20, 0),
(3104, 'Efecto Alien 1', 'Traw el pequeño alien travieso y sus bombas', 'pocion', '', 'Alien_Regalo_1', '8', 1, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '0.7', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 43, 60, 0),
(3105, 'Efecto Alien 2', 'Jenvy siempre está tranquilo. Pero no le molestes!', 'pocion', '', 'Alien_Regalo_2', '8', 1, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '0.7', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 44, 60, 0),
(3106, 'Efecto Alien 3', 'Los hermanos Wippers están siempre juntos en sus batallas', 'pocion', '', 'Alien_Regalo_3', '8', 1, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '0.7', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 45, 60, 0),
(3107, 'Efecto Alien 4', 'Antty con sus antenas localiza a sus enemigos, no se les escapan!', 'pocion', '', 'Alien_Regalo_4', '8', 1, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '0.7', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 46, 60, 0),
(3108, 'Efecto Alien 5', 'Gekro y su robot destructor siempre listos!', 'pocion', '', 'Alien_Regalo_5', '8', 1, 0, 25, 0, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '0.7', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 47, 60, 0),
(3109, 'Anti Uppercut', 'Compra Oro: Requiere 10 Torneos Ring | Compra Plata: Requiere 500 Torneos Ring', '', '', 'AntiUpper', '17', 1, 0, 75000, 60000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '1', '', '', '0', 0, 0, 0, '0', '', 0, 1, 1, 28, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3110, 'Ninja Celestial', 'Escapa de tus rivales. Tienes 4 segundos tras pegar punch para escapar.', '', '', 'Ninja_Celeste', '13', 1, 0, 150000, 120000, -1, 0, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '0.5', '', '', '0', 0, 0, 0, '0', '', 0, 1, 1, 28, '17 Antiguo', '0', 0, 0, -1, NULL, NULL, 0),
(3111, 'Efecto Alien 1 [VIP]', 'Traw el pequeño alien travieso y sus bombas', 'pocion', '', 'Alien_Regalo_1', '8', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '0.7', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 43, 60, 0),
(3112, 'Efecto Alien 2 [VIP]', 'Jenvy siempre está tranquilo. Pero no le molestes!', 'pocion', '', 'Alien_Regalo_2', '8', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '0.7', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 44, 60, 0),
(3113, 'Efecto Alien 3 [VIP]', 'Los hermanos Wippers están siempre juntos en sus batallas', 'pocion', '', 'Alien_Regalo_3', '8', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '0.7', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 45, 60, 0),
(3114, 'Efecto Alien 4 [VIP]', 'Antty con sus antenas localiza a sus enemigos, no se les escapan!', 'pocion', '', 'Alien_Regalo_4', '8', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '0.7', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 46, 60, 0),
(3115, 'Efecto Alien 5 [VIP]', 'Gekro y su robot destructor siempre listos!', 'pocion', '', 'Alien_Regalo_5', '8', 0, 0, -1, 0, 1000, 1, 0, '', '', 'parte_1', 'parte_2', 'parte_3', 'parte_4', '0', '0.7', '', '', '0', 0, 0, 0, '0', '', 1, 0, 1, 28, '17 Antiguo', '0', 0, 0, -1, 47, 60, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetos_comprados`
--

CREATE TABLE `objetos_comprados` (
  `id` int(11) NOT NULL,
  `objeto_id` int(11) NOT NULL,
  `posX` int(11) NOT NULL DEFAULT 0,
  `posY` int(11) NOT NULL DEFAULT 0,
  `colores_hex` varchar(50) NOT NULL,
  `colores_rgb` varchar(50) NOT NULL,
  `rotation` int(11) NOT NULL DEFAULT 0,
  `tam` varchar(10) NOT NULL DEFAULT 'tam_n',
  `espacio_ocupado` varchar(500) NOT NULL,
  `sala_id` int(11) NOT NULL DEFAULT 0,
  `data` varchar(150) NOT NULL,
  `contador` int(11) NOT NULL DEFAULT 0,
  `usuario_id` int(11) NOT NULL,
  `loteria_numero` int(11) NOT NULL DEFAULT 0,
  `planta_agua` int(11) NOT NULL DEFAULT 0,
  `planta_sol` int(11) NOT NULL DEFAULT 0,
  `id_objeto_2` int(1) NOT NULL DEFAULT -1,
  `open` int(1) NOT NULL DEFAULT 0,
  `active` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `objetos_comprados`
--

INSERT INTO `objetos_comprados` (`id`, `objeto_id`, `posX`, `posY`, `colores_hex`, `colores_rgb`, `rotation`, `tam`, `espacio_ocupado`, `sala_id`, `data`, `contador`, `usuario_id`, `loteria_numero`, `planta_agua`, `planta_sol`, `id_objeto_2`, `open`, `active`, `created_at`, `updated_at`) VALUES
(2229, 972, 426, 395, 'E0E5C6D7D8D5CCC7B2DBC16A', '72,72,90,72,72,85,72,72,80,72,72,86', 0, 'tam_n', '14,17', 9112, '0', 0, 5009, 0, 0, 0, -1, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_pendientes`
--

CREATE TABLE `pagos_pendientes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rankings`
--

CREATE TABLE `rankings` (
  `id` int(11) NOT NULL,
  `id_ranking` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo_ranking` int(11) NOT NULL,
  `puntos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperaciones`
--

CREATE TABLE `recuperaciones` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `enviado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `recuperaciones`
--

INSERT INTO `recuperaciones` (`id`, `id_usuario`, `codigo`, `enviado`) VALUES
(24, 1285, 673398, 1584549008);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_recuperacion_cuentas`
--

CREATE TABLE `ticket_recuperacion_cuentas` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `usuario_nombre` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `clave` varchar(255) DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trampas_privadas`
--

CREATE TABLE `trampas_privadas` (
  `id` int(11) NOT NULL,
  `modelo` int(11) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `mover_x` int(11) NOT NULL DEFAULT -1,
  `mover_y` int(11) NOT NULL DEFAULT -1,
  `expulsar_usuario` int(11) NOT NULL DEFAULT 0 COMMENT '0=No expulsar; 1=Expulsar',
  `escenario_id` int(11) NOT NULL DEFAULT -1,
  `es_categoria` int(11) NOT NULL DEFAULT -1 COMMENT '0=Privados; 1=Publicos',
  `go_escenario_id` int(11) NOT NULL DEFAULT -1,
  `go_es_categoria` int(11) NOT NULL DEFAULT -1 COMMENT '0 = Privado; 1= Publico',
  `go_escenario_x` int(11) NOT NULL DEFAULT -1,
  `go_escenario_y` int(11) NOT NULL DEFAULT -1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trampas_publicas`
--

CREATE TABLE `trampas_publicas` (
  `id` int(11) NOT NULL,
  `modelo` int(11) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `mover_x` int(11) NOT NULL DEFAULT -1,
  `mover_y` int(11) NOT NULL DEFAULT -1,
  `expulsar_usuario` int(11) NOT NULL DEFAULT 0 COMMENT '0=No expulsar; 1=Expulsar',
  `escenario_id` int(11) NOT NULL DEFAULT -1,
  `es_categoria` int(11) NOT NULL DEFAULT 1 COMMENT '0=Privados; 1=Publicos',
  `go_escenario_id` int(11) NOT NULL DEFAULT -1,
  `go_es_categoria` int(11) NOT NULL DEFAULT 1 COMMENT '0 = Privado; 1= Publico',
  `go_escenario_x` int(11) NOT NULL DEFAULT -1,
  `go_escenario_y` int(11) NOT NULL DEFAULT -1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trampas_publicas`
--

INSERT INTO `trampas_publicas` (`id`, `modelo`, `x`, `y`, `mover_x`, `mover_y`, `expulsar_usuario`, `escenario_id`, `es_categoria`, `go_escenario_id`, `go_es_categoria`, `go_escenario_x`, `go_escenario_y`) VALUES
(1, 0, 9, 16, -1, -1, 1, 3, 1, -1, -1, -1, -1),
(2, 3, 15, 21, -1, -1, 0, 30, 1, 35, 1, 7, 10),
(3, 2, 20, 8, -1, -1, 0, 30, 1, 29, 1, 7, 18),
(4, 4, 8, 19, -1, -1, 0, 29, 1, 30, 1, 19, 7),
(6, 3, 16, 21, -1, -1, 0, 29, 1, 34, 1, 6, 10),
(7, 5, 7, 10, -1, -1, 0, 34, 1, 29, 1, 16, 22),
(8, 4, 8, 19, -1, -1, 0, 34, 1, 35, 1, 18, 8),
(9, 2, 17, 7, -1, -1, 0, 35, 1, 34, 1, 7, 18),
(10, 5, 8, 10, -1, -1, 0, 35, 1, 30, 1, 16, 21),
(11, 3, 14, 22, -1, -1, 0, 35, 1, 40, 1, 6, 11),
(12, 5, 5, 11, -1, -1, 0, 40, 1, 35, 1, 15, 21),
(13, 3, 17, 19, -1, -1, 0, 40, 1, 45, 1, 8, 9),
(14, 5, 7, 10, -1, -1, 0, 45, 1, 40, 1, 16, 19),
(15, 3, 16, 23, -1, -1, 0, 45, 1, 50, 1, 8, 8),
(16, 5, 7, 9, -1, -1, 0, 50, 1, 45, 1, 17, 22),
(17, 2, 20, 7, -1, -1, 0, 50, 1, 49, 1, 10, 21),
(18, 4, 9, 20, -1, -1, 0, 49, 1, 50, 1, 21, 8),
(19, 2, 22, 10, -1, -1, 0, 49, 1, 48, 1, 9, 20),
(20, 4, 8, 19, -1, -1, 0, 48, 1, 49, 1, 21, 9),
(21, 2, 15, 4, -1, -1, 0, 48, 1, 47, 1, 7, 18),
(22, 4, 6, 17, -1, -1, 0, 47, 1, 48, 1, 14, 4),
(23, 2, 20, 7, -1, -1, 0, 47, 1, 46, 1, 8, 19),
(24, 4, 7, 18, -1, -1, 0, 46, 1, 47, 1, 6, 10),
(25, 5, 7, 9, -1, -1, 0, 46, 1, 41, 1, 17, 22),
(26, 3, 18, 21, -1, -1, 0, 41, 1, 46, 1, 6, 10),
(27, 5, 8, 8, -1, -1, 0, 41, 1, 36, 1, 17, 22),
(28, 3, 18, 21, -1, -1, 0, 36, 1, 41, 1, 7, 9),
(29, 5, 9, 9, -1, -1, 0, 36, 1, 31, 1, 16, 22),
(30, 3, 17, 21, -1, -1, 0, 31, 1, 36, 1, 8, 10),
(31, 5, 8, 8, -1, -1, 0, 31, 1, 26, 1, 16, 23),
(32, 3, 17, 22, -1, -1, 0, 26, 1, 31, 1, 7, 9),
(33, 4, 8, 19, -1, -1, 0, 26, 1, 27, 1, 20, 8),
(34, 2, 21, 9, -1, -1, 0, 27, 1, 26, 1, 7, 18),
(35, 4, 9, 20, -1, -1, 0, 27, 1, 28, 1, 19, 7),
(36, 2, 20, 8, -1, -1, 0, 28, 1, 27, 1, 10, 21),
(37, 4, 9, 20, -1, -1, 0, 28, 1, 29, 1, 21, 9),
(38, 2, 22, 10, -1, -1, 0, 29, 1, 28, 1, 10, 21),
(39, 3, 16, 23, -1, -1, 0, 34, 1, 39, 1, 4, 13),
(40, 5, 5, 12, -1, -1, 0, 39, 1, 34, 1, 15, 24),
(41, 4, 9, 20, -1, -1, 0, 39, 1, 40, 1, 22, 11),
(42, 2, 21, 10, -1, -1, 0, 40, 1, 39, 1, 10, 21),
(43, 3, 17, 22, -1, -1, 0, 39, 1, 44, 1, 6, 10),
(44, 5, 7, 9, -1, -1, 0, 44, 1, 39, 1, 16, 23),
(45, 4, 8, 19, -1, -1, 0, 44, 1, 45, 1, 18, 7),
(46, 2, 19, 8, -1, -1, 0, 45, 1, 44, 1, 7, 18),
(47, 3, 17, 21, -1, -1, 0, 44, 1, 49, 1, 9, 7),
(48, 5, 10, 6, -1, -1, 0, 49, 1, 44, 1, 16, 22),
(49, 5, 7, 9, -1, -1, 0, 48, 1, 43, 1, 17, 22),
(50, 3, 18, 21, -1, -1, 0, 43, 1, 48, 1, 6, 10),
(51, 4, 4, 15, -1, -1, 0, 43, 1, 44, 1, 18, 7),
(52, 2, 19, 8, -1, -1, 0, 44, 1, 43, 1, 5, 16),
(53, 5, 9, 7, -1, -1, 0, 43, 1, 38, 1, 15, 18),
(54, 3, 16, 17, -1, -1, 0, 38, 1, 43, 1, 8, 8),
(55, 2, 18, 8, -1, -1, 0, 38, 1, 37, 1, 7, 18),
(56, 4, 8, 19, -1, -1, 0, 37, 1, 38, 1, 17, 7),
(57, 2, 20, 8, -1, -1, 0, 37, 1, 36, 1, 7, 18),
(58, 4, 8, 19, -1, -1, 0, 36, 1, 37, 1, 19, 7),
(59, 3, 18, 21, -1, -1, 0, 37, 1, 42, 1, 6, 10),
(60, 5, 7, 9, -1, -1, 0, 42, 1, 37, 1, 17, 22),
(61, 4, 10, 21, -1, -1, 0, 42, 1, 43, 1, 21, 8),
(62, 2, 20, 7, -1, -1, 0, 43, 1, 42, 1, 9, 20),
(63, 2, 21, 9, -1, -1, 0, 42, 1, 41, 1, 10, 21),
(64, 4, 11, 21, -1, -1, 0, 41, 1, 42, 1, 20, 8),
(65, 3, 18, 21, -1, -1, 0, 42, 1, 47, 1, 3, 13),
(66, 5, 4, 12, -1, -1, 0, 47, 1, 42, 1, 17, 22),
(67, 5, 7, 9, -1, -1, 0, 37, 1, 32, 1, 17, 22),
(68, 3, 18, 21, -1, -1, 0, 32, 1, 37, 1, 6, 10),
(69, 4, 8, 19, -1, -1, 0, 32, 1, 33, 1, 21, 9),
(70, 2, 20, 8, -1, -1, 0, 33, 1, 32, 1, 7, 18),
(71, 5, 4, 13, -1, -1, 0, 32, 1, 27, 1, 15, 24),
(72, 3, 16, 23, -1, -1, 0, 27, 1, 32, 1, 5, 12),
(73, 2, 19, 6, -1, -1, 0, 32, 1, 31, 1, 7, 18),
(74, 4, 8, 19, -1, -1, 0, 31, 1, 32, 1, 20, 7),
(75, 3, 17, 21, -1, -1, 0, 33, 1, 38, 1, 9, 8),
(76, 5, 8, 9, -1, -1, 0, 38, 1, 33, 1, 18, 20),
(77, 4, 9, 20, -1, -1, 0, 33, 1, 34, 1, 20, 9),
(78, 2, 20, 10, -1, -1, 0, 34, 1, 33, 1, 10, 21),
(79, 5, 8, 8, -1, -1, 0, 33, 1, 28, 1, 17, 22),
(80, 3, 18, 21, -1, -1, 0, 28, 1, 33, 1, 6, 10),
(81, 14, 11, 16, -1, -1, 0, 38, 1, 52, 1, 11, 11),
(82, 9, 5, 12, -1, -1, 0, 52, 1, 38, 1, 12, 16),
(83, 15, 9, 12, -1, -1, 0, 48, 1, 55, 1, 5, 13),
(84, 5, 4, 13, -1, -1, 0, 55, 1, 48, 1, 9, 11),
(85, 0, 8, 18, -1, -1, 0, 78, 1, 79, 1, 22, 9),
(86, 0, 21, 8, -1, -1, 0, 79, 1, 78, 1, 9, 19),
(87, 0, 10, 21, -1, -1, 0, 79, 1, 80, 1, 22, 9),
(88, 0, 23, 10, -1, -1, 0, 80, 1, 79, 1, 9, 20),
(89, 15, 11, 11, -1, -1, 0, 79, 1, 95, 1, 8, 11),
(90, 5, 7, 11, -1, -1, 0, 95, 1, 79, 1, 11, 12),
(91, 0, 8, 18, -1, -1, 0, 80, 1, 81, 1, 22, 9),
(92, 0, 21, 8, -1, -1, 0, 81, 1, 80, 1, 9, 19),
(93, 0, 15, 23, -1, -1, 0, 78, 1, 82, 1, 7, 9),
(94, 0, 6, 10, -1, -1, 0, 82, 1, 78, 1, 16, 22),
(95, 0, 8, 19, -1, -1, 0, 82, 1, 83, 1, 17, 5),
(96, 0, 16, 4, -1, -1, 0, 83, 1, 82, 1, 7, 18),
(97, 0, 12, 5, -1, -1, 0, 83, 1, 79, 1, 16, 21),
(98, 0, 15, 22, -1, -1, 0, 79, 1, 83, 1, 13, 4),
(99, 0, 8, 19, -1, -1, 0, 83, 1, 84, 1, 21, 8),
(100, 0, 20, 7, -1, -1, 0, 84, 1, 83, 1, 13, 4),
(101, 0, 7, 9, -1, -1, 0, 84, 1, 80, 1, 18, 21),
(102, 0, 17, 22, -1, -1, 0, 80, 1, 84, 1, 8, 8),
(105, 0, 11, 21, -1, -1, 0, 84, 1, 85, 1, 21, 7),
(106, 0, 22, 8, -1, -1, 0, 85, 1, 84, 1, 12, 22),
(107, 0, 5, 11, -1, -1, 0, 85, 1, 81, 1, 17, 22),
(108, 0, 16, 23, -1, -1, 0, 81, 1, 85, 1, 6, 10),
(109, 0, 15, 24, -1, -1, 0, 82, 1, 86, 1, 5, 12),
(110, 0, 4, 13, -1, -1, 0, 86, 1, 82, 1, 16, 23),
(111, 14, 10, 13, -1, -1, 0, 86, 1, 96, 1, 10, 21),
(112, 16, 9, 20, -1, -1, 0, 96, 1, 86, 1, 11, 14),
(113, 0, 10, 20, -1, -1, 0, 86, 1, 87, 1, 23, 11),
(114, 0, 23, 10, -1, -1, 0, 87, 1, 86, 1, 9, 19),
(115, 0, 4, 12, -1, -1, 0, 87, 1, 83, 1, 13, 23),
(116, 0, 12, 22, -1, -1, 0, 83, 1, 87, 1, 5, 11),
(117, 0, 15, 24, -1, -1, 0, 84, 1, 88, 1, 5, 11),
(118, 0, 4, 12, -1, -1, 0, 88, 1, 84, 1, 16, 23),
(119, 0, 12, 22, -1, -1, 0, 88, 1, 89, 1, 22, 10),
(120, 0, 23, 11, -1, -1, 0, 89, 1, 88, 1, 11, 21),
(121, 0, 5, 12, -1, -1, 0, 89, 1, 85, 1, 16, 23),
(122, 0, 15, 24, -1, -1, 0, 85, 1, 89, 1, 6, 11),
(123, 0, 15, 24, -1, -1, 0, 86, 1, 90, 1, 5, 11),
(124, 0, 4, 12, -1, -1, 0, 90, 1, 86, 1, 16, 23),
(126, 0, 5, 15, -1, -1, 0, 90, 1, 91, 1, 16, 3),
(127, 0, 17, 4, -1, -1, 0, 91, 1, 90, 1, 6, 16),
(128, 0, 4, 12, -1, -1, 0, 91, 1, 87, 1, 16, 23),
(129, 0, 15, 24, -1, -1, 0, 87, 1, 91, 1, 5, 11),
(130, 0, 6, 17, -1, -1, 0, 91, 1, 92, 1, 19, 6),
(131, 0, 18, 5, -1, -1, 0, 92, 1, 91, 1, 7, 18),
(132, 0, 4, 12, -1, -1, 0, 92, 1, 88, 1, 14, 21),
(133, 0, 16, 23, -1, -1, 0, 88, 1, 92, 1, 5, 11),
(134, 0, 9, 19, -1, -1, 0, 92, 1, 93, 1, 17, 4),
(135, 0, 18, 5, -1, -1, 0, 93, 1, 92, 1, 8, 18),
(136, 0, 4, 12, -1, -1, 0, 93, 1, 89, 1, 16, 23),
(137, 0, 15, 24, -1, -1, 0, 89, 1, 93, 1, 5, 11),
(138, 0, 9, 20, -1, -1, 0, 57, 1, 58, 1, 21, 8),
(139, 0, 22, 9, -1, -1, 0, 58, 1, 57, 1, 8, 19),
(140, 14, 11, 18, -1, -1, 0, 58, 1, 74, 1, 9, 9),
(141, 0, 8, 8, -1, -1, 0, 74, 1, 58, 1, 12, 18),
(142, 0, 11, 21, -1, -1, 0, 58, 1, 59, 1, 22, 10),
(143, 0, 21, 9, -1, -1, 0, 59, 1, 58, 1, 10, 20),
(144, 0, 11, 21, -1, -1, 0, 59, 1, 60, 1, 22, 10),
(145, 0, 21, 9, -1, -1, 0, 60, 1, 59, 1, 10, 20),
(146, 0, 18, 21, -1, -1, 0, 57, 1, 61, 1, 6, 12),
(147, 0, 5, 11, -1, -1, 0, 61, 1, 57, 1, 17, 20),
(148, 0, 8, 18, -1, -1, 0, 61, 1, 62, 1, 18, 6),
(149, 0, 19, 7, -1, -1, 0, 62, 1, 61, 1, 9, 19),
(150, 0, 4, 12, -1, -1, 0, 62, 1, 58, 1, 14, 23),
(151, 0, 15, 24, -1, -1, 0, 58, 1, 62, 1, 5, 13),
(152, 0, 5, 15, -1, -1, 0, 62, 1, 63, 1, 17, 4),
(153, 0, 18, 5, -1, -1, 0, 63, 1, 62, 1, 6, 16),
(154, 0, 9, 8, -1, -1, 0, 63, 1, 59, 1, 17, 20),
(155, 0, 18, 21, -1, -1, 0, 59, 1, 63, 1, 10, 9),
(156, 0, 11, 21, -1, -1, 0, 63, 1, 64, 1, 21, 8),
(157, 0, 22, 9, -1, -1, 0, 64, 1, 63, 1, 12, 22),
(158, 0, 7, 9, -1, -1, 0, 64, 1, 60, 1, 16, 21),
(159, 0, 17, 22, -1, -1, 0, 60, 1, 64, 1, 8, 10),
(160, 0, 17, 22, -1, -1, 0, 61, 1, 65, 1, 7, 11),
(161, 0, 6, 10, -1, -1, 0, 65, 1, 61, 1, 16, 21),
(162, 0, 5, 15, -1, -1, 0, 65, 1, 66, 1, 17, 6),
(163, 0, 16, 5, -1, -1, 0, 66, 1, 65, 1, 6, 16),
(164, 0, 7, 10, -1, -1, 0, 66, 1, 62, 1, 14, 18),
(165, 0, 15, 19, -1, -1, 0, 62, 1, 66, 1, 8, 11),
(166, 0, 9, 19, -1, -1, 0, 66, 1, 67, 1, 19, 8),
(167, 0, 20, 9, -1, -1, 0, 67, 1, 66, 1, 10, 20),
(168, 0, 4, 12, -1, -1, 0, 67, 1, 63, 1, 14, 23),
(169, 0, 15, 24, -1, -1, 0, 63, 1, 67, 1, 5, 13),
(170, 0, 11, 21, -1, -1, 0, 67, 1, 68, 1, 22, 9),
(171, 0, 21, 8, -1, -1, 0, 68, 1, 67, 1, 10, 20),
(172, 0, 4, 12, -1, -1, 0, 68, 1, 64, 1, 15, 22),
(173, 0, 16, 23, -1, -1, 0, 64, 1, 68, 1, 5, 13),
(174, 0, 19, 14, -1, -1, 0, 65, 1, 69, 1, 9, 9),
(175, 0, 8, 8, -1, -1, 0, 69, 1, 65, 1, 19, 13),
(176, 0, 11, 15, -1, -1, 0, 69, 1, 73, 1, 8, 16),
(177, 0, 8, 14, -1, -1, 0, 73, 1, 69, 1, 9, 14),
(178, 0, 16, 23, -1, -1, 0, 66, 1, 70, 1, 6, 12),
(179, 0, 5, 11, -1, -1, 0, 70, 1, 66, 1, 17, 22),
(180, 0, 7, 17, -1, -1, 0, 70, 1, 71, 1, 18, 6),
(181, 0, 19, 7, -1, -1, 0, 71, 1, 70, 1, 6, 16),
(182, 0, 6, 10, -1, -1, 0, 71, 1, 67, 1, 16, 21),
(183, 0, 17, 22, -1, -1, 0, 67, 1, 71, 1, 7, 11),
(184, 0, 10, 20, -1, -1, 0, 71, 1, 72, 1, 20, 7),
(185, 0, 21, 8, -1, -1, 0, 72, 1, 71, 1, 9, 19),
(186, 0, 6, 10, -1, -1, 0, 72, 1, 68, 1, 15, 22),
(187, 0, 16, 23, -1, -1, 0, 68, 1, 72, 1, 7, 11),
(188, 0, 14, 14, -1, -1, 1, 214, 1, 215, 1, 15, 16),
(189, 6, 14, 15, -1, -1, 1, 215, 1, 214, 1, 11, 11),
(194, 9, 6, 11, -1, -1, 0, 215, 1, 216, 1, 17, 19),
(195, 7, 17, 21, -1, -1, 0, 216, 1, 215, 1, 7, 11),
(196, 8, 10, 20, -1, -1, 0, 216, 1, 217, 1, 20, 8),
(197, 6, 21, 9, -1, -1, 0, 217, 1, 216, 1, 11, 21),
(198, 8, 11, 20, -1, -1, 0, 217, 1, 218, 1, 21, 9),
(199, 6, 22, 10, -1, -1, 0, 218, 1, 217, 1, 10, 19),
(200, 8, 11, 21, -1, -1, 0, 218, 1, 219, 1, 21, 8),
(201, 6, 22, 9, -1, -1, 0, 219, 1, 218, 1, 11, 20),
(202, 7, 17, 20, -1, -1, 0, 219, 1, 223, 1, 11, 8),
(203, 9, 9, 9, -1, -1, 0, 223, 1, 219, 1, 17, 19),
(204, 6, 21, 7, -1, -1, 0, 223, 1, 222, 1, 9, 17),
(205, 8, 8, 17, -1, -1, 0, 222, 1, 223, 1, 20, 7),
(206, 9, 7, 11, -1, -1, 0, 222, 1, 218, 1, 16, 20),
(207, 9, 17, 21, -1, -1, 0, 218, 1, 222, 1, 8, 11),
(208, 6, 20, 7, -1, -1, 0, 222, 1, 220, 1, 8, 17),
(209, 8, 9, 18, -1, -1, 0, 220, 1, 222, 1, 19, 7),
(210, 9, 9, 8, -1, -1, 0, 220, 1, 217, 1, 17, 19),
(211, 7, 17, 20, -1, -1, 0, 217, 1, 220, 1, 10, 8),
(212, 6, 20, 6, -1, -1, 0, 220, 1, 215, 1, 9, 19),
(213, 8, 9, 20, -1, -1, 0, 215, 1, 220, 1, 19, 6),
(214, 7, 16, 22, -1, -1, 0, 215, 1, 224, 1, 7, 11),
(215, 9, 6, 11, -1, -1, 0, 224, 1, 215, 1, 16, 21),
(216, 8, 9, 20, -1, -1, 0, 224, 1, 225, 1, 22, 8),
(217, 6, 21, 7, -1, -1, 0, 225, 1, 224, 1, 9, 19),
(218, 9, 5, 13, -1, -1, 0, 225, 1, 220, 1, 14, 21),
(219, 7, 14, 23, -1, -1, 0, 220, 1, 225, 1, 6, 13),
(220, 8, 9, 18, -1, -1, 0, 225, 1, 226, 1, 21, 7),
(221, 6, 20, 6, -1, -1, 0, 226, 1, 225, 1, 9, 17),
(222, 9, 8, 11, -1, -1, 0, 226, 1, 222, 1, 16, 19),
(223, 7, 16, 20, -1, -1, 0, 222, 1, 226, 1, 9, 11),
(224, 8, 10, 19, -1, -1, 0, 226, 1, 227, 1, 21, 9),
(225, 6, 21, 8, -1, -1, 0, 227, 1, 226, 1, 11, 19),
(226, 9, 8, 10, -1, -1, 0, 227, 1, 223, 1, 18, 18),
(227, 7, 18, 19, -1, -1, 0, 223, 1, 227, 1, 9, 10),
(228, 7, 18, 20, -1, -1, 0, 227, 1, 231, 1, 9, 11),
(229, 9, 8, 10, -1, -1, 0, 231, 1, 227, 1, 18, 19),
(230, 7, 14, 18, -1, -1, 0, 231, 1, 232, 1, 15, 20),
(231, 7, 15, 21, -1, -1, 0, 232, 1, 231, 1, 14, 17),
(232, 6, 18, 7, -1, -1, 0, 231, 1, 230, 1, 7, 16),
(233, 8, 7, 17, -1, -1, 0, 230, 1, 231, 1, 17, 7),
(234, 9, 7, 12, -1, -1, 0, 230, 1, 226, 1, 17, 19),
(235, 7, 17, 21, -1, -1, 0, 226, 1, 230, 1, 8, 12),
(236, 6, 18, 6, -1, -1, 0, 230, 1, 229, 1, 8, 16),
(237, 8, 8, 17, -1, -1, 0, 229, 1, 230, 1, 17, 6),
(238, 9, 8, 12, -1, -1, 0, 229, 1, 225, 1, 17, 19),
(239, 7, 18, 19, -1, -1, 0, 225, 1, 229, 1, 9, 12),
(240, 6, 19, 7, -1, -1, 0, 229, 1, 228, 1, 8, 17),
(241, 8, 9, 18, -1, -1, 0, 228, 1, 229, 1, 18, 7),
(242, 9, 7, 11, -1, -1, 0, 228, 1, 224, 1, 17, 20),
(243, 7, 16, 22, -1, -1, 0, 224, 1, 228, 1, 8, 11),
(244, 9, 9, 15, -1, -1, 0, 232, 1, 233, 1, 14, 10),
(245, 6, 15, 11, -1, -1, 0, 233, 1, 232, 1, 10, 15),
(246, 8, 10, 20, -1, -1, 0, 233, 1, 236, 1, 20, 6),
(247, 6, 21, 7, -1, -1, 0, 236, 1, 233, 1, 10, 19),
(248, 7, 17, 21, -1, -1, 0, 236, 1, 237, 1, 7, 11),
(249, 9, 6, 10, -1, -1, 0, 237, 1, 236, 1, 17, 20),
(250, 6, 22, 8, -1, -1, 0, 237, 1, 234, 1, 9, 18),
(251, 8, 9, 19, -1, -1, 0, 234, 1, 237, 1, 21, 8),
(252, 9, 7, 10, -1, -1, 0, 234, 1, 233, 1, 18, 19),
(253, 7, 19, 20, -1, -1, 0, 233, 1, 234, 1, 8, 11),
(254, 7, 18, 20, -1, -1, 0, 234, 1, 235, 1, 8, 11),
(255, 9, 7, 11, -1, -1, 0, 235, 1, 234, 1, 17, 19),
(256, 8, 8, 19, -1, -1, 0, 235, 1, 238, 1, 20, 7),
(257, 6, 21, 8, -1, -1, 0, 238, 1, 235, 1, 8, 18),
(258, 9, 6, 11, -1, -1, 0, 238, 1, 237, 1, 17, 20),
(259, 7, 17, 21, -1, -1, 0, 237, 1, 238, 1, 7, 11),
(710, 0, 38, 17, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(711, 0, 30, 42, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(712, 0, 25, 41, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(713, 0, 19, 32, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(714, 0, 28, 31, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(715, 0, 9, 25, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(716, 0, 25, 16, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(717, 0, 12, 27, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(718, 0, 35, 24, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(719, 0, 30, 43, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(720, 0, 19, 15, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(721, 0, 45, 20, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(722, 0, 40, 14, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(723, 0, 41, 13, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(724, 0, 14, 32, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(725, 0, 39, 37, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(726, 0, 39, 15, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(727, 0, 41, 24, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(728, 0, 28, 40, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(729, 0, 24, 18, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(730, 0, 22, 11, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(731, 0, 27, 23, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(732, 0, 31, 17, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(733, 0, 38, 16, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(734, 0, 30, 12, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(735, 0, 32, 11, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(736, 0, 33, 39, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(737, 0, 23, 32, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(738, 0, 41, 25, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(739, 0, 21, 13, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(740, 0, 21, 31, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(741, 0, 25, 30, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(742, 0, 36, 36, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(743, 0, 37, 42, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(744, 0, 36, 14, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(745, 0, 24, 19, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(746, 0, 10, 32, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(747, 0, 14, 31, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(748, 0, 13, 30, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(749, 0, 25, 21, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(750, 0, 35, 42, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(751, 0, 14, 26, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(752, 0, 25, 25, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(753, 0, 31, 19, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(754, 0, 41, 18, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(755, 0, 11, 30, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(756, 0, 42, 23, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(757, 0, 44, 14, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(758, 0, 9, 27, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(759, 0, 20, 32, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(760, 0, 33, 25, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(761, 0, 25, 37, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(762, 0, 26, 24, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(763, 0, 27, 18, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(764, 0, 26, 29, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(765, 0, 36, 20, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(766, 0, 34, 10, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(767, 0, 38, 23, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(768, 0, 14, 23, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(769, 0, 33, 47, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(770, 0, 33, 45, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(771, 0, 43, 22, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(772, 0, 38, 40, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(773, 0, 20, 23, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(774, 0, 20, 14, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(775, 0, 46, 19, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(776, 0, 30, 13, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(777, 0, 36, 12, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(778, 0, 10, 31, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(779, 0, 26, 18, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(780, 0, 45, 23, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(781, 0, 33, 42, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(782, 0, 34, 19, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(783, 0, 27, 13, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(784, 0, 37, 24, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(785, 0, 14, 24, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(786, 0, 35, 39, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(787, 0, 37, 17, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(788, 0, 39, 9, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(789, 0, 38, 11, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(790, 0, 35, 10, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(791, 0, 19, 36, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(792, 0, 25, 42, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(793, 0, 9, 26, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(794, 0, 19, 25, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(795, 0, 26, 31, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(796, 0, 25, 43, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(797, 0, 34, 44, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(798, 0, 35, 45, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(799, 0, 28, 44, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(800, 0, 25, 12, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(801, 0, 23, 11, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(802, 0, 28, 41, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(803, 0, 16, 19, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(804, 0, 30, 44, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(805, 0, 25, 22, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(806, 0, 15, 25, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(807, 0, 19, 19, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(808, 0, 14, 30, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(809, 0, 31, 12, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(810, 0, 40, 18, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(811, 0, 19, 18, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(812, 0, 13, 27, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(813, 0, 24, 26, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(814, 0, 36, 43, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(815, 0, 36, 42, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(816, 0, 16, 26, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(817, 0, 25, 20, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(818, 0, 43, 14, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(819, 0, 18, 24, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(820, 0, 10, 30, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(821, 0, 14, 21, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(822, 0, 28, 20, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(823, 0, 18, 16, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(824, 0, 11, 22, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(825, 0, 22, 33, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(826, 0, 25, 32, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(827, 0, 36, 21, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(828, 0, 19, 24, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(829, 0, 34, 23, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(830, 0, 40, 17, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(831, 0, 33, 28, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(832, 0, 35, 37, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(833, 0, 16, 22, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(834, 0, 26, 33, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(835, 0, 9, 24, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(836, 0, 17, 18, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(837, 0, 22, 34, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(838, 0, 28, 18, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(839, 0, 27, 21, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(840, 0, 26, 37, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(841, 0, 29, 41, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(842, 0, 24, 25, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(843, 0, 29, 19, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(844, 0, 27, 22, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(845, 0, 16, 25, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(846, 0, 30, 24, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(847, 0, 29, 18, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(848, 0, 31, 27, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(849, 0, 39, 11, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(850, 0, 21, 33, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(851, 0, 16, 27, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(852, 0, 33, 27, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(853, 0, 46, 18, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(854, 0, 25, 15, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(855, 0, 16, 21, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(856, 0, 45, 14, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(857, 0, 10, 26, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(858, 0, 15, 20, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(859, 0, 21, 35, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(860, 0, 25, 36, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(861, 0, 30, 18, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(862, 0, 32, 44, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(863, 0, 32, 32, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(864, 0, 34, 38, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(865, 0, 29, 24, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(866, 0, 17, 22, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(867, 0, 25, 19, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(868, 0, 36, 44, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(869, 0, 35, 19, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(870, 0, 20, 19, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(871, 0, 31, 44, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(872, 0, 33, 31, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(873, 0, 19, 17, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(874, 0, 33, 16, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(875, 0, 18, 22, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(876, 0, 24, 42, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(877, 0, 42, 16, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(878, 0, 17, 17, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(879, 0, 11, 32, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(880, 0, 16, 31, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(881, 0, 10, 23, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(882, 0, 41, 17, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(883, 0, 35, 28, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(884, 0, 18, 29, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(885, 0, 21, 20, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(886, 0, 22, 26, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(887, 0, 24, 43, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(888, 0, 32, 26, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(889, 0, 29, 38, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(890, 0, 23, 25, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(891, 0, 18, 28, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(892, 0, 32, 20, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(893, 0, 33, 10, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(894, 0, 28, 46, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(895, 0, 22, 32, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(896, 0, 17, 28, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(897, 0, 42, 15, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(898, 0, 33, 44, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(899, 0, 37, 10, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(900, 0, 25, 33, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(901, 0, 28, 30, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(902, 0, 34, 29, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(903, 0, 12, 33, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(904, 0, 38, 10, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(905, 0, 19, 26, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(906, 0, 19, 22, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(907, 0, 28, 35, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(908, 0, 29, 29, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(909, 0, 39, 39, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(910, 0, 20, 22, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(911, 0, 15, 29, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(912, 0, 12, 30, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(913, 0, 23, 27, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(914, 0, 23, 37, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(915, 0, 27, 15, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(916, 0, 39, 38, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(917, 0, 11, 26, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(918, 0, 14, 33, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(919, 0, 20, 34, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(920, 0, 16, 28, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(921, 0, 23, 34, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(922, 0, 11, 27, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(923, 0, 14, 22, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(924, 0, 36, 10, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(925, 0, 21, 12, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(926, 0, 24, 32, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(927, 0, 9, 28, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(928, 0, 28, 23, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(929, 0, 33, 41, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(930, 0, 28, 39, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(931, 0, 25, 17, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(932, 0, 29, 23, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(933, 0, 34, 45, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(934, 0, 17, 25, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(935, 0, 37, 33, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(936, 0, 9, 29, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(937, 0, 31, 37, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(938, 0, 34, 42, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(939, 0, 24, 40, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(940, 0, 19, 16, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(941, 0, 35, 44, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(942, 0, 30, 28, 16, 40, 0, 176, 1, -1, 1, -1, -1),
(943, 0, 21, 30, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(944, 0, 19, 21, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(945, 0, 18, 27, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(946, 0, 42, 25, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(947, 0, 35, 27, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(948, 0, 11, 28, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(949, 0, 19, 27, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(950, 0, 31, 8, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(951, 0, 17, 32, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(952, 0, 39, 16, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(953, 0, 33, 2, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(954, 0, 27, 33, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(955, 0, 29, 40, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(956, 0, 32, 39, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(957, 0, 34, 32, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(958, 0, 33, 4, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(959, 0, 21, 25, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(960, 0, 40, 15, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(961, 0, 18, 16, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(962, 0, 30, 33, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(963, 0, 32, 40, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(964, 0, 40, 17, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(965, 0, 12, 18, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(966, 0, 30, 17, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(967, 0, 8, 22, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(968, 0, 14, 28, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(969, 0, 33, 28, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(970, 0, 19, 18, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(971, 0, 17, 33, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(972, 0, 15, 22, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(973, 0, 18, 17, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(974, 0, 40, 28, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(975, 0, 36, 33, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(976, 0, 20, 33, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(977, 0, 26, 40, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(978, 0, 24, 39, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(979, 0, 32, 7, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(980, 0, 16, 30, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(981, 0, 21, 29, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(982, 0, 30, 41, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(983, 0, 39, 19, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(984, 0, 11, 19, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(985, 0, 28, 10, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(986, 0, 14, 23, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(987, 0, 13, 30, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(988, 0, 35, 13, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(989, 0, 32, 43, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(990, 0, 15, 23, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(991, 0, 32, 34, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(992, 0, 19, 29, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(993, 0, 28, 41, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(994, 0, 37, 10, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(995, 0, 17, 23, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(996, 0, 27, 40, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(997, 0, 41, 22, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(998, 0, 29, 34, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(999, 0, 16, 29, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1000, 0, 25, 41, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1001, 0, 31, 41, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1002, 0, 41, 18, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1003, 0, 20, 23, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1004, 0, 36, 22, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1005, 0, 45, 21, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1006, 0, 13, 29, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1007, 0, 19, 28, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1008, 0, 36, 27, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1009, 0, 12, 28, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1010, 0, 36, 9, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1011, 0, 17, 18, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1012, 0, 33, 29, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1013, 0, 25, 12, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1014, 0, 25, 13, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1015, 0, 36, 24, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1016, 0, 14, 24, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1017, 0, 20, 24, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1018, 0, 41, 14, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1019, 0, 27, 15, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1020, 0, 26, 14, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1021, 0, 19, 20, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1022, 0, 16, 22, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1023, 0, 19, 17, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1024, 0, 33, 16, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1025, 0, 20, 21, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1026, 0, 44, 20, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1027, 0, 26, 10, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1028, 0, 26, 9, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1029, 0, 32, 35, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1030, 0, 26, 13, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1031, 0, 29, 42, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1032, 0, 27, 19, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1033, 0, 23, 11, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1034, 0, 18, 19, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1035, 0, 29, 18, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1036, 0, 29, 35, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1037, 0, 14, 30, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1038, 0, 43, 19, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1039, 0, 26, 34, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1040, 0, 17, 24, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1041, 0, 10, 19, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1042, 0, 17, 30, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1043, 0, 25, 35, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1044, 0, 40, 26, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1045, 0, 35, 25, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1046, 0, 19, 26, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1047, 0, 32, 37, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1048, 0, 40, 16, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1049, 0, 17, 28, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1050, 0, 25, 36, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1051, 0, 32, 42, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1052, 0, 21, 13, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1053, 0, 36, 13, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1054, 0, 23, 12, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1055, 0, 38, 10, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1056, 0, 42, 15, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1057, 0, 18, 15, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1058, 0, 44, 13, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1059, 0, 16, 20, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1060, 0, 40, 19, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1061, 0, 39, 24, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1062, 0, 20, 31, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1063, 0, 35, 15, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1064, 0, 24, 11, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1065, 0, 26, 41, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1066, 0, 31, 40, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1067, 0, 29, 44, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1068, 0, 42, 14, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1069, 0, 23, 44, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1070, 0, 9, 20, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1071, 0, 30, 19, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1072, 0, 27, 11, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1073, 0, 18, 31, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1074, 0, 31, 36, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1075, 0, 35, 14, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1076, 0, 30, 43, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1077, 0, 20, 14, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1078, 0, 26, 12, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1079, 0, 41, 19, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1080, 0, 23, 37, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1081, 0, 48, 20, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1082, 0, 36, 20, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1083, 0, 20, 20, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1084, 0, 26, 20, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1085, 0, 16, 32, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1086, 0, 32, 31, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1087, 0, 14, 29, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1088, 0, 36, 32, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1089, 0, 35, 4, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1090, 0, 34, 16, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1091, 0, 15, 29, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1092, 0, 44, 19, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1093, 0, 31, 37, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1094, 0, 33, 15, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1095, 0, 32, 44, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1096, 0, 31, 43, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1097, 0, 21, 14, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1098, 0, 20, 25, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1099, 0, 25, 11, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1100, 0, 24, 10, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1101, 0, 16, 24, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1102, 0, 16, 23, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1103, 0, 17, 22, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1104, 0, 18, 35, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1105, 0, 28, 34, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1106, 0, 31, 19, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1107, 0, 22, 13, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1108, 0, 39, 23, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1109, 0, 19, 35, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1110, 0, 26, 39, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1111, 0, 31, 35, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1112, 0, 23, 24, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1113, 0, 20, 16, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1114, 0, 40, 27, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1115, 0, 16, 33, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1116, 0, 32, 32, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1117, 0, 18, 18, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1118, 0, 7, 23, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1119, 0, 14, 22, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1120, 0, 35, 21, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1121, 0, 34, 28, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1122, 0, 10, 28, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1123, 0, 43, 26, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1124, 0, 32, 38, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1125, 0, 34, 4, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1126, 0, 27, 14, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1127, 0, 22, 25, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1128, 0, 15, 30, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1129, 0, 43, 13, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1130, 0, 24, 12, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1131, 0, 33, 31, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1132, 0, 32, 2, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1133, 0, 21, 28, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1134, 0, 9, 21, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1135, 0, 40, 18, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1136, 0, 38, 9, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1137, 0, 41, 23, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1138, 0, 29, 20, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1139, 0, 18, 20, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1140, 0, 40, 25, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1141, 0, 13, 17, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1142, 0, 25, 34, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1143, 0, 33, 41, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1144, 0, 42, 19, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1145, 0, 41, 24, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1146, 0, 22, 31, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1147, 0, 41, 15, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1148, 0, 26, 11, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1149, 0, 25, 10, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1150, 0, 33, 30, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1151, 0, 22, 26, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1152, 0, 21, 32, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1153, 0, 34, 9, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1154, 0, 25, 40, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1155, 0, 39, 22, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1156, 0, 39, 17, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1157, 0, 35, 33, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1158, 0, 22, 24, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1159, 0, 36, 23, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1160, 0, 22, 12, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1161, 0, 31, 42, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1162, 0, 33, 39, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1163, 0, 18, 28, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1164, 0, 34, 3, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1165, 0, 20, 34, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1166, 0, 28, 19, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1167, 0, 21, 24, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1168, 0, 31, 38, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1169, 0, 18, 29, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1170, 0, 20, 15, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1171, 0, 30, 20, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1172, 0, 18, 33, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1173, 0, 24, 40, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1174, 0, 22, 27, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1175, 0, 30, 40, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1176, 0, 32, 41, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1177, 0, 41, 16, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1178, 0, 33, 32, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1179, 0, 21, 39, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1180, 0, 31, 16, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1181, 0, 33, 6, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1182, 0, 31, 34, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1183, 0, 24, 20, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1184, 0, 47, 20, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1185, 0, 43, 21, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1186, 0, 32, 6, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1187, 0, 30, 34, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1188, 0, 17, 29, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1189, 0, 12, 17, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1190, 0, 30, 42, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1191, 0, 41, 26, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1192, 0, 36, 14, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1193, 0, 23, 40, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1194, 0, 24, 36, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1195, 0, 27, 35, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1196, 0, 32, 36, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1197, 0, 34, 31, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1198, 0, 17, 19, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1199, 0, 19, 15, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1200, 0, 28, 40, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1201, 0, 31, 39, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1202, 0, 39, 25, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1203, 0, 23, 20, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1204, 0, 28, 16, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1205, 0, 27, 10, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1206, 0, 16, 21, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1207, 0, 25, 21, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1208, 0, 22, 37, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1209, 0, 42, 21, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1210, 0, 18, 25, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1211, 0, 24, 38, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1212, 0, 34, 2, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1213, 0, 26, 33, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1214, 0, 18, 34, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1215, 0, 25, 37, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1216, 0, 15, 32, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1217, 0, 15, 24, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1218, 0, 32, 17, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1219, 0, 34, 15, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1220, 0, 41, 20, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1221, 0, 13, 28, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1222, 0, 42, 27, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1223, 0, 17, 20, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1224, 0, 33, 7, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1225, 0, 22, 40, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1226, 0, 30, 48, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1227, 0, 40, 20, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1228, 0, 33, 40, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1229, 0, 21, 31, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1230, 0, 18, 32, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1231, 0, 18, 24, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1232, 0, 31, 7, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1233, 0, 37, 29, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1234, 0, 29, 9, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1235, 0, 47, 21, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1236, 0, 30, 35, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1237, 0, 21, 20, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1238, 0, 19, 16, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1239, 0, 8, 21, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1240, 0, 30, 36, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1241, 0, 19, 34, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1242, 0, 17, 34, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1243, 0, 31, 33, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1244, 0, 34, 26, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1245, 0, 15, 25, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1246, 0, 10, 20, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1247, 0, 23, 39, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1248, 0, 46, 19, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1249, 0, 33, 5, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1250, 0, 29, 41, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1251, 0, 26, 36, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1252, 0, 11, 18, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1253, 0, 19, 19, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1254, 0, 28, 15, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1255, 0, 37, 21, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1256, 0, 20, 30, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1257, 0, 43, 24, 13, 33, 0, 128, 1, -1, 1, -1, -1),
(1258, 7, 16, 18, -1, -1, 0, 239, 1, 240, 1, 10, 11),
(1259, 9, 11, 11, -1, -1, 0, 240, 1, 239, 1, 15, 17),
(1260, 7, 10, 21, -1, -1, 0, 240, 1, 241, 1, 11, 11),
(1261, 9, 11, 10, -1, -1, 0, 241, 1, 240, 1, 11, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_armario`
--

CREATE TABLE `user_armario` (
  `id` int(11) NOT NULL,
  `avatar_id` int(11) NOT NULL,
  `colores` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `nombre_antiguo` varchar(211) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `baneo` int(11) NOT NULL DEFAULT 0,
  `contador_baneo` int(11) NOT NULL DEFAULT 0,
  `security` varchar(50) NOT NULL DEFAULT '',
  `avatar` int(11) NOT NULL,
  `colores` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `email_validado` int(11) NOT NULL DEFAULT 0,
  `edad` int(11) NOT NULL,
  `ip_registro` varchar(25) NOT NULL DEFAULT '',
  `ip_actual` varchar(25) NOT NULL DEFAULT '',
  `oro` int(11) NOT NULL DEFAULT 0,
  `plata` int(11) NOT NULL DEFAULT 5000,
  `vip` int(11) NOT NULL DEFAULT 0,
  `end_vip` varchar(25) NOT NULL DEFAULT '',
  `admin` int(11) NOT NULL DEFAULT 0,
  `bocadillo` varchar(80) NOT NULL DEFAULT 'Hola!, Soy nuevo en Yocomania',
  `hobby_1` varchar(25) NOT NULL DEFAULT 'Vacío',
  `hobby_2` varchar(25) NOT NULL DEFAULT 'Vacío',
  `hobby_3` varchar(25) NOT NULL DEFAULT 'Vacío',
  `deseo_1` varchar(25) NOT NULL DEFAULT 'Vacío',
  `deseo_2` varchar(25) NOT NULL DEFAULT 'Vacío',
  `deseo_3` varchar(25) NOT NULL DEFAULT 'Vacío',
  `votos_sexy` int(11) NOT NULL DEFAULT 50,
  `votos_legal` int(11) NOT NULL DEFAULT 50,
  `votos_simpatico` int(11) NOT NULL DEFAULT 50,
  `votos_restantes` int(11) NOT NULL DEFAULT 5,
  `votos_recarga` int(11) NOT NULL DEFAULT 0,
  `besos_enviados` int(11) NOT NULL DEFAULT 0,
  `besos_recibidos` int(11) NOT NULL DEFAULT 0,
  `jugos_enviados` int(11) NOT NULL DEFAULT 0,
  `jugos_recibidos` int(11) NOT NULL DEFAULT 0,
  `flores_enviadas` int(11) NOT NULL DEFAULT 0,
  `flores_recibidas` int(11) NOT NULL DEFAULT 0,
  `uppers_enviados` int(11) NOT NULL DEFAULT 0,
  `uppers_recibidos` int(11) NOT NULL DEFAULT 0,
  `cocos_enviados` int(11) NOT NULL DEFAULT 0,
  `cocos_recibidos` int(11) NOT NULL DEFAULT 0,
  `rings_ganados` int(11) NOT NULL DEFAULT 0,
  `senderos_ganados` int(11) NOT NULL DEFAULT 0,
  `toneos_ring` int(11) NOT NULL DEFAULT 0,
  `puntos_cocos` int(11) NOT NULL DEFAULT 0,
  `torneos_coco` int(11) NOT NULL DEFAULT 0,
  `puntos_ninja` int(11) NOT NULL DEFAULT 0,
  `t_n_p` int(11) NOT NULL DEFAULT 0,
  `coins_remain` int(11) NOT NULL DEFAULT 900,
  `tutorial_islas` int(11) NOT NULL DEFAULT 1,
  `timespam_regalo_peque` int(11) NOT NULL DEFAULT 0,
  `timespam_regalo_grande` int(11) NOT NULL DEFAULT 0,
  `timespam_desc_cambios` int(11) NOT NULL DEFAULT 0,
  `ultima_conexion` varchar(50) NOT NULL DEFAULT '',
  `fecha_registro` varchar(100) NOT NULL,
  `novedades_noticias` int(11) NOT NULL DEFAULT 1,
  `cambio_nombre` int(11) NOT NULL DEFAULT 0,
  `noticia_registro` int(11) NOT NULL DEFAULT 1,
  `ver_ranking` int(11) NOT NULL DEFAULT 2,
  `remember_token` varchar(255) NOT NULL DEFAULT '',
  `Online` int(11) NOT NULL DEFAULT 0,
  `token` varchar(100) DEFAULT NULL,
  `active_token` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(255) DEFAULT NULL,
  `card_brand` varchar(255) DEFAULT NULL,
  `card_last_four` varchar(4) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `nombre_antiguo`, `password`, `baneo`, `contador_baneo`, `security`, `avatar`, `colores`, `email`, `email_validado`, `edad`, `ip_registro`, `ip_actual`, `oro`, `plata`, `vip`, `end_vip`, `admin`, `bocadillo`, `hobby_1`, `hobby_2`, `hobby_3`, `deseo_1`, `deseo_2`, `deseo_3`, `votos_sexy`, `votos_legal`, `votos_simpatico`, `votos_restantes`, `votos_recarga`, `besos_enviados`, `besos_recibidos`, `jugos_enviados`, `jugos_recibidos`, `flores_enviadas`, `flores_recibidas`, `uppers_enviados`, `uppers_recibidos`, `cocos_enviados`, `cocos_recibidos`, `rings_ganados`, `senderos_ganados`, `toneos_ring`, `puntos_cocos`, `torneos_coco`, `puntos_ninja`, `t_n_p`, `coins_remain`, `tutorial_islas`, `timespam_regalo_peque`, `timespam_regalo_grande`, `timespam_desc_cambios`, `ultima_conexion`, `fecha_registro`, `novedades_noticias`, `cambio_nombre`, `noticia_registro`, `ver_ranking`, `remember_token`, `Online`, `token`, `active_token`, `created_at`, `updated_at`, `stripe_id`, `card_brand`, `card_last_four`, `trial_ends_at`) VALUES
(5008, 'Gen', NULL, '0222223333334444444444455555555555555555555555677888999999', 0, 0, '', 3, 'B88A5CFF99000099CC0099CCE31709FFFFFF336666', 'x@gmail.com', 0, 19, '127.0.0.1', '127.0.0.1', 0, 6000, 0, '', 0, 'Hola!, Soy nuevo en Yocomania', 'Vacío', 'Vacío', 'Vacío', 'Vacío', 'Vacío', 'Vacío', 50, 50, 50, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 846, 1, 1626264962, 1626291968, 0, '2021-07-14 15:01:49', '2021-07-14 11:36:18', 1, 0, 0, 2, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5009, 'Gen1', NULL, '022222333333444455555555555555555555567789', 0, 0, '', 3, 'B88A5CFF99000099CC0099CCE31709FFFFFF336666', 'x@gmail.com', 0, 19, '127.0.0.1', '127.0.0.1', 100, 6505, 0, '', 0, 'Hola!, Soy nuevo en Yocomania', 'Vacío', 'Vacío', 'Vacío', 'Vacío', 'Vacío', 'Vacío', 50, 50, 50, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 401, 1, 1626692124, 1626570457, 0, '2021-07-18 10:54:58', '2021-07-14 11:39:25', 0, 0, 0, 2, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web`
--

CREATE TABLE `web` (
  `id` int(11) NOT NULL,
  `mantenimiento` int(11) NOT NULL DEFAULT 0,
  `users_online` varchar(15) NOT NULL DEFAULT '0',
  `evento` int(11) NOT NULL DEFAULT 0,
  `navidad` varchar(211) NOT NULL,
  `halloween` varchar(211) NOT NULL,
  `svalentin` varchar(211) NOT NULL,
  `pascua` varchar(211) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `web`
--

INSERT INTO `web` (`id`, `mantenimiento`, `users_online`, `evento`, `navidad`, `halloween`, `svalentin`, `pascua`) VALUES
(1, 0, '0', 0, '/play/navidad.php', '/play/halloween.php', '/play/svalentin.php', '/play/pascua.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web_contactos`
--

CREATE TABLE `web_contactos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `contenido` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `web_contactos`
--

INSERT INTO `web_contactos` (`id`, `nombre`, `subject`, `contenido`, `email`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'sadfdasf', 'BoomBang - Yocomania', 'prueba prueba', 'keylorubio@gmail.com', 1, '2020-12-12 07:26:32', '2020-12-12 07:26:32'),
(2, 'Mohamed', 'BoomBang - Yocomania', 'Hola hola', 'keylorubio@gmail.com', 1, '2020-12-12 07:27:30', '2020-12-12 07:27:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web_eventos`
--

CREATE TABLE `web_eventos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `link` varchar(255) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL COMMENT '1 = Video Promocional\r\n2 = evento',
  `user_id` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `color` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `web_eventos`
--

INSERT INTO `web_eventos` (`id`, `nombre`, `titulo`, `alias`, `descripcion`, `fecha`, `link`, `tipo`, `user_id`, `active`, `color`, `image`, `created_at`, `updated_at`) VALUES
(1, NULL, '', NULL, NULL, '2020-12-30 10:42:45', 'https://www.youtube.com/embed/3fItSOolRj8', 1, 0, 1, 0, '', NULL, NULL),
(2, NULL, '', NULL, NULL, '2020-12-30 10:42:46', 'https://www.youtube.com/embed/Ivqa-Rtvt0Q', 1, 0, 1, 0, '', NULL, NULL),
(3, NULL, '', NULL, NULL, '2020-12-30 10:42:47', 'https://www.youtube.com/embed/ouXW3__EMtE', 1, 0, 1, 0, '', NULL, NULL),
(4, NULL, '', NULL, NULL, '2020-12-30 10:42:48', 'https://www.youtube.com/embed/zEIsG6XGltE', 1, 0, 1, 0, '', NULL, NULL),
(5, NULL, '', NULL, NULL, '2020-12-30 10:42:49', 'https://www.youtube.com/embed/CmEwlMB9sso', 1, 0, 1, 0, '', NULL, NULL),
(7, 'Hola mundo', 'Hola mundo xd', NULL, 'Concurso de flores locas en la isla Isi_Love.\r\nParticipa y gana:\r\n10.000 Créditos de oro O.O', '2020-12-30 10:42:52', '/images/eventos/flores.png', 2, 0, 1, 1, '', NULL, NULL),
(18, NULL, NULL, NULL, NULL, '2020-12-30 10:42:53', 'https://www.youtube.com/embed/zEIsG6XGltE', 1, 0, 1, NULL, NULL, '2020-12-10 10:27:45', '2020-12-10 10:27:45'),
(19, NULL, NULL, NULL, NULL, '2020-12-31 10:17:00', 'https://www.youtube.com/embed/zEIsG6XGltE', 1, 2, 1, NULL, NULL, '2020-12-30 09:53:28', '2020-12-31 09:17:00'),
(20, 'Evento 1', 'hola hola', NULL, 'sdfasdf', '2021-01-09 20:47:00', '', 2, 0, 1, NULL, NULL, '2021-01-09 19:48:19', '2021-01-09 19:48:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web_gamefichas`
--

CREATE TABLE `web_gamefichas` (
  `id` int(11) NOT NULL,
  `ficha_id` int(11) NOT NULL,
  `nombreImg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `web_gamefichas`
--

INSERT INTO `web_gamefichas` (`id`, `ficha_id`, `nombreImg`) VALUES
(1, 1001, 'fichaMoradaClara.png'),
(2, 1002, 'fichaCeleste.png'),
(3, 1003, 'fichaMagenta.png'),
(4, 1004, 'fichaChiclet.png'),
(5, 1006, 'fichaRoja.png'),
(6, 1007, 'fichaNaranja.png'),
(7, 1008, 'fichaVerde.png'),
(8, 1009, 'fichaRoza.png'),
(9, 1010, 'fichaPlatina.png'),
(10, 18, 'fichaMuscle.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web_images`
--

CREATE TABLE `web_images` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `titulo` varchar(10) DEFAULT NULL,
  `descripcion` varchar(75) NOT NULL,
  `link` varchar(255) NOT NULL,
  `tipo` int(1) NOT NULL COMMENT '1 = Screenshot\r\n2 = FanArt',
  `active` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `web_images`
--

INSERT INTO `web_images` (`id`, `user_id`, `titulo`, `descripcion`, `link`, `tipo`, `active`, `created_at`, `updated_at`) VALUES
(1, 0, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.', '/images/screenshots/1924210030.png', 1, 1, '2020-12-10 08:56:40', '2020-12-10 08:56:40'),
(2, 0, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.', '/images/screenshots/1352616230.png', 1, 1, '2020-12-10 08:57:17', '2020-12-10 08:57:17'),
(3, 0, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.', '/images/screenshots/1970124332.png', 1, 1, '2020-12-10 08:57:22', '2020-12-10 08:57:22'),
(4, 0, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.', '/images/screenshots/893791840.png', 1, 1, '2020-12-10 08:57:28', '2020-12-10 08:57:28'),
(5, 0, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.', '/images/screenshots/1644455196.png', 1, 1, '2020-12-10 09:06:32', '2020-12-10 09:06:32'),
(6, 0, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.', '/images/screenshots/1956734924.png', 1, 1, '2020-12-10 09:06:51', '2020-12-10 09:06:51'),
(7, 0, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.', '/images/fanart/1478293920.jpg', 2, 1, '2020-12-11 05:52:51', '2020-12-11 05:52:51'),
(8, 0, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.', '/images/fanart/1785337579.jpg', 2, 1, '2020-12-11 05:55:28', '2020-12-11 05:55:28'),
(9, 0, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.', '/images/fanart/994048894.jpg', 2, 1, '2020-12-11 05:58:17', '2020-12-11 05:58:17'),
(10, 0, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.', '/images/fanart/849289907.png', 2, 1, '2020-12-11 05:58:32', '2020-12-11 05:58:32'),
(11, 0, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.', '/images/fanart/373679389.png', 2, 1, '2020-12-11 05:58:37', '2020-12-11 05:58:37'),
(12, 0, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.', '/images/fanart/1200308463.jpg', 2, 1, '2020-12-11 05:58:41', '2020-12-11 05:58:41'),
(13, 0, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.', '/images/fanart/1164635320.jpg', 2, 1, '2020-12-11 05:58:45', '2020-12-11 05:58:45'),
(14, 0, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.', '/images/fanart/304312633.jpg', 2, 1, '2020-12-11 05:58:52', '2020-12-11 05:58:52'),
(15, 2, NULL, 'hola mundo', '/images/screenshots/702288426.png', 1, 0, '2020-12-30 09:21:42', '2020-12-31 08:18:21'),
(19, 2, NULL, 'Hola mundo jaja', '/images/screenshots/1034437924.jpg', 1, 0, '2020-12-31 08:21:25', '2020-12-31 08:21:40'),
(20, 2, NULL, 'Hola', '/images/fanart/566048961.jpg', 2, 1, '2020-12-31 08:56:01', '2020-12-31 09:01:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web_objetos_ventas`
--

CREATE TABLE `web_objetos_ventas` (
  `id` int(11) NOT NULL,
  `objeto_id` int(11) NOT NULL,
  `compra_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `oro` int(11) NOT NULL DEFAULT -1,
  `plata` int(11) NOT NULL DEFAULT -1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `web_objetos_ventas`
--

INSERT INTO `web_objetos_ventas` (`id`, `objeto_id`, `compra_id`, `usuario_id`, `oro`, `plata`, `created_at`, `updated_at`) VALUES
(20, 547, 298, 4435, -1, 1000, '2021-01-14 07:44:17', '2021-01-14 07:44:17'),
(21, 547, 303, 4435, -1, 1000, '2021-01-14 07:44:27', '2021-01-14 07:44:27'),
(23, 721, 304, 4435, 1000, -1, '2021-01-14 07:44:35', '2021-01-14 07:44:35'),
(25, 720, 1394, 4435, 60000, -1, '2021-01-14 10:49:25', '2021-01-14 10:49:25'),
(26, 602, 2225, 4435, 60000, -1, '2021-01-14 10:54:34', '2021-01-14 10:54:34'),
(81, 652, 562, 4471, 10000, -1, '2021-01-18 09:29:22', '2021-01-18 09:29:22'),
(82, 654, 635, 4435, -1, 5000, '2021-01-24 09:32:55', '2021-01-24 09:32:55'),
(83, 602, 2226, 4435, -1, 90000, '2021-01-27 15:35:50', '2021-01-27 15:35:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web_supports`
--

CREATE TABLE `web_supports` (
  `id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `comentario` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web_support_messages`
--

CREATE TABLE `web_support_messages` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `subject` varchar(100) NOT NULL,
  `contenido` text NOT NULL,
  `visto` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web_tienda_creditos`
--

CREATE TABLE `web_tienda_creditos` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `precio` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web_tienda_fichas`
--

CREATE TABLE `web_tienda_fichas` (
  `id` int(11) NOT NULL,
  `ficha_img` varchar(100) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `ficha_id` int(11) NOT NULL,
  `oro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web_tweets`
--

CREATE TABLE `web_tweets` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `tweet` varchar(200) NOT NULL,
  `likes` int(11) NOT NULL DEFAULT 0,
  `comunicado` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web_tweets_likes`
--

CREATE TABLE `web_tweets_likes` (
  `id` int(11) NOT NULL,
  `tweet_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `armario_fichas`
--
ALTER TABLE `armario_fichas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bb_managers`
--
ALTER TABLE `bb_managers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bpad_amigos`
--
ALTER TABLE `bpad_amigos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bpad_mensajes`
--
ALTER TABLE `bpad_mensajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indices de la tabla `codigos_promocionales`
--
ALTER TABLE `codigos_promocionales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `concurso_objetos`
--
ALTER TABLE `concurso_objetos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cuentas_desactivadas`
--
ALTER TABLE `cuentas_desactivadas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `escenarios_favoritos`
--
ALTER TABLE `escenarios_favoritos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `escenarios_mgame`
--
ALTER TABLE `escenarios_mgame`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `escenarios_npc`
--
ALTER TABLE `escenarios_npc`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `escenarios_privados`
--
ALTER TABLE `escenarios_privados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `escenarios_publicos`
--
ALTER TABLE `escenarios_publicos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `islas`
--
ALTER TABLE `islas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`login_details_id`);

--
-- Indices de la tabla `mapas_mgame`
--
ALTER TABLE `mapas_mgame`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mapas_privados`
--
ALTER TABLE `mapas_privados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mapas_publicos`
--
ALTER TABLE `mapas_publicos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `object_npc`
--
ALTER TABLE `object_npc`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `object_npc_id`
--
ALTER TABLE `object_npc_id`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `objetos`
--
ALTER TABLE `objetos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `objetos_comprados`
--
ALTER TABLE `objetos_comprados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos_pendientes`
--
ALTER TABLE `pagos_pendientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rankings`
--
ALTER TABLE `rankings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recuperaciones`
--
ALTER TABLE `recuperaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ticket_recuperacion_cuentas`
--
ALTER TABLE `ticket_recuperacion_cuentas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trampas_privadas`
--
ALTER TABLE `trampas_privadas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trampas_publicas`
--
ALTER TABLE `trampas_publicas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_armario`
--
ALTER TABLE `user_armario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `web`
--
ALTER TABLE `web`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `web_contactos`
--
ALTER TABLE `web_contactos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `web_eventos`
--
ALTER TABLE `web_eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `web_gamefichas`
--
ALTER TABLE `web_gamefichas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `web_images`
--
ALTER TABLE `web_images`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `web_objetos_ventas`
--
ALTER TABLE `web_objetos_ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `web_supports`
--
ALTER TABLE `web_supports`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `web_support_messages`
--
ALTER TABLE `web_support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `web_tienda_creditos`
--
ALTER TABLE `web_tienda_creditos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `web_tienda_fichas`
--
ALTER TABLE `web_tienda_fichas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `web_tweets`
--
ALTER TABLE `web_tweets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `web_tweets_likes`
--
ALTER TABLE `web_tweets_likes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `armario_fichas`
--
ALTER TABLE `armario_fichas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1079;

--
-- AUTO_INCREMENT de la tabla `bpad_amigos`
--
ALTER TABLE `bpad_amigos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT de la tabla `bpad_mensajes`
--
ALTER TABLE `bpad_mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `codigos_promocionales`
--
ALTER TABLE `codigos_promocionales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `concurso_objetos`
--
ALTER TABLE `concurso_objetos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `cuentas_desactivadas`
--
ALTER TABLE `cuentas_desactivadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `escenarios_favoritos`
--
ALTER TABLE `escenarios_favoritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `escenarios_mgame`
--
ALTER TABLE `escenarios_mgame`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `escenarios_npc`
--
ALTER TABLE `escenarios_npc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `escenarios_privados`
--
ALTER TABLE `escenarios_privados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9113;

--
-- AUTO_INCREMENT de la tabla `escenarios_publicos`
--
ALTER TABLE `escenarios_publicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT de la tabla `islas`
--
ALTER TABLE `islas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=371;

--
-- AUTO_INCREMENT de la tabla `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT de la tabla `mapas_mgame`
--
ALTER TABLE `mapas_mgame`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `mapas_privados`
--
ALTER TABLE `mapas_privados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `mapas_publicos`
--
ALTER TABLE `mapas_publicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=374;

--
-- AUTO_INCREMENT de la tabla `object_npc`
--
ALTER TABLE `object_npc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT de la tabla `object_npc_id`
--
ALTER TABLE `object_npc_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT de la tabla `objetos`
--
ALTER TABLE `objetos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3116;

--
-- AUTO_INCREMENT de la tabla `objetos_comprados`
--
ALTER TABLE `objetos_comprados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2230;

--
-- AUTO_INCREMENT de la tabla `pagos_pendientes`
--
ALTER TABLE `pagos_pendientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `rankings`
--
ALTER TABLE `rankings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `recuperaciones`
--
ALTER TABLE `recuperaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `ticket_recuperacion_cuentas`
--
ALTER TABLE `ticket_recuperacion_cuentas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `trampas_privadas`
--
ALTER TABLE `trampas_privadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de la tabla `trampas_publicas`
--
ALTER TABLE `trampas_publicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1262;

--
-- AUTO_INCREMENT de la tabla `user_armario`
--
ALTER TABLE `user_armario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5010;

--
-- AUTO_INCREMENT de la tabla `web`
--
ALTER TABLE `web`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `web_contactos`
--
ALTER TABLE `web_contactos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `web_eventos`
--
ALTER TABLE `web_eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `web_gamefichas`
--
ALTER TABLE `web_gamefichas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `web_images`
--
ALTER TABLE `web_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `web_objetos_ventas`
--
ALTER TABLE `web_objetos_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `web_supports`
--
ALTER TABLE `web_supports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `web_support_messages`
--
ALTER TABLE `web_support_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2117;

--
-- AUTO_INCREMENT de la tabla `web_tienda_creditos`
--
ALTER TABLE `web_tienda_creditos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `web_tienda_fichas`
--
ALTER TABLE `web_tienda_fichas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `web_tweets`
--
ALTER TABLE `web_tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `web_tweets_likes`
--
ALTER TABLE `web_tweets_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
