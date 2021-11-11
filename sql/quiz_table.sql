CREATE TABLE quiz (
  eid text NOT NULL,
  title varchar(100) NOT NULL,
  wrong int(11) NOT NULL,
  total int(11) NOT NULL,
  date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
