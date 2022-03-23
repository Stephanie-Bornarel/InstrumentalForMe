CREATE DATABASE IF NOT EXISTS `INSTRUMENTAL_FOR_ME_-MAJ` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `INSTRUMENTAL_FOR_ME_-MAJ`;

CREATE TABLE `TEACHER` (
  `teacher_id` VARCHAR(42),
  `email` VARCHAR(42),
  `password` VARCHAR(42),
  `firstname` VARCHAR(42),
  `lastname` VARCHAR(42),
  `role` VARCHAR(42),
  `avatar` VARCHAR(42),
  `description` VARCHAR(42),
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `LESSON` (
  `lesson_id` VARCHAR(42),
  `appointment` VARCHAR(42),
  `status` VARCHAR(42),
  `email_student:` VARCHAR(42),
  `instrument_id` VARCHAR(42),
  `teacher_id` VARCHAR(42),
  `student_id` VARCHAR(42),
  PRIMARY KEY (`lesson_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `STUDENT` (
  `student_id` VARCHAR(42),
  `email` VARCHAR(42),
  `password` VARCHAR(42),
  `firstname` VARCHAR(42),
  `lastname` VARCHAR(42),
  `role` VARCHAR(42),
  `avatar` VARCHAR(42),
  `description` VARCHAR(42),
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `TEACH` (
  `teacher_id` VARCHAR(42),
  `instrument_id` VARCHAR(42),
  PRIMARY KEY (`teacher_id`, `instrument_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `INSTRUMENT` (
  `instrument_id` VARCHAR(42),
  `name` VARCHAR(42),
  `decsription` VARCHAR(42),
  `picture` VARCHAR(42),
  PRIMARY KEY (`instrument_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `LEARN` (
  `student_id` VARCHAR(42),
  `instrument_id` VARCHAR(42),
  PRIMARY KEY (`student_id`, `instrument_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `TEACHER_HAS` (
  `teacher_id` VARCHAR(42),
  `style_id` VARCHAR(42),
  PRIMARY KEY (`teacher_id`, `style_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `MUSIC_STYLE` (
  `style_id` VARCHAR(42),
  `name` VARCHAR(42),
  `decsription` VARCHAR(42),
  PRIMARY KEY (`style_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `STUDENT_HAS` (
  `student_id` VARCHAR(42),
  `style_id` VARCHAR(42),
  PRIMARY KEY (`student_id`, `style_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `HAS_CERTIFICATE` (
  `teacher_id` VARCHAR(42),
  `certificate_id` VARCHAR(42),
  PRIMARY KEY (`teacher_id`, `certificate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `CERTIFICATE` (
  `certificate_id` VARCHAR(42),
  `name` VARCHAR(42),
  `decsription` VARCHAR(42),
  PRIMARY KEY (`certificate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `LESSON` ADD FOREIGN KEY (`student_id`) REFERENCES `STUDENT` (`student_id`);
ALTER TABLE `LESSON` ADD FOREIGN KEY (`teacher_id`) REFERENCES `TEACHER` (`teacher_id`);
ALTER TABLE `LESSON` ADD FOREIGN KEY (`instrument_id`) REFERENCES `INSTRUMENT` (`instrument_id`);
ALTER TABLE `TEACH` ADD FOREIGN KEY (`instrument_id`) REFERENCES `INSTRUMENT` (`instrument_id`);
ALTER TABLE `TEACH` ADD FOREIGN KEY (`teacher_id`) REFERENCES `TEACHER` (`teacher_id`);
ALTER TABLE `LEARN` ADD FOREIGN KEY (`instrument_id`) REFERENCES `INSTRUMENT` (`instrument_id`);
ALTER TABLE `LEARN` ADD FOREIGN KEY (`student_id`) REFERENCES `STUDENT` (`student_id`);
ALTER TABLE `TEACHER_HAS` ADD FOREIGN KEY (`style_id`) REFERENCES `MUSIC_STYLE` (`style_id`);
ALTER TABLE `TEACHER_HAS` ADD FOREIGN KEY (`teacher_id`) REFERENCES `TEACHER` (`teacher_id`);
ALTER TABLE `STUDENT_HAS` ADD FOREIGN KEY (`style_id`) REFERENCES `MUSIC_STYLE` (`style_id`);
ALTER TABLE `STUDENT_HAS` ADD FOREIGN KEY (`student_id`) REFERENCES `STUDENT` (`student_id`);
ALTER TABLE `HAS_CERTIFICATE` ADD FOREIGN KEY (`certificate_id`) REFERENCES `CERTIFICATE` (`certificate_id`);
ALTER TABLE `HAS_CERTIFICATE` ADD FOREIGN KEY (`teacher_id`) REFERENCES `TEACHER` (`teacher_id`);