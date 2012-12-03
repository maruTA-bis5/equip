CREATE TABLE `{prefix}_{dirname}_items` (
  `items_id` int(11) unsigned NOT NULL  auto_increment,
  `name` varchar(255) NOT NULL,
  `types_id` int(11) unsigned NOT NULL,
  `info` varchar(255) NOT NULL,
  `count` int(11) unsigned NOT NULL,
  `posttime` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`items_id`)) ENGINE=MyISAM;

CREATE TABLE `{prefix}_{dirname}_types` (
  `types_id` int(11) unsigned NOT NULL  auto_increment,
  `name` varchar(255) NOT NULL,
  `posttime` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`types_id`)) ENGINE=MyISAM;

