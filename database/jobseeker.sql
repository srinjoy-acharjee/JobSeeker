-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `js_admin`;
CREATE TABLE `js_admin` (
  `Admin_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Admin_Email` varchar(255) NOT NULL,
  `Admin_Password` varchar(255) NOT NULL,
  `Admin_Name` varchar(255) NOT NULL,
  `Admin_Phone` varchar(255) NOT NULL,
  `Admin_Status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `Admin_Last_Login` datetime NOT NULL,
  `Admin_Regd_On` datetime NOT NULL,
  PRIMARY KEY (`Admin_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `js_admin` (`Admin_ID`, `Admin_Email`, `Admin_Password`, `Admin_Name`, `Admin_Phone`, `Admin_Status`, `Admin_Last_Login`, `Admin_Regd_On`) VALUES
(1,	'priyanka.pramanik710@gmail.com',	'7c4a8d09ca3762af61e59520943dc26494f8941b',	'Administrator',	'+91-9876543210',	'Active',	'2017-12-14 10:28:27',	'2017-12-13 07:24:27');

DROP TABLE IF EXISTS `js_apply`;
CREATE TABLE `js_apply` (
  `Apply_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Apply_Job_ID` int(11) NOT NULL,
  `Apply_Company_ID` int(11) NOT NULL,
  `Apply_Seeker_ID` int(11) NOT NULL,
  `Apply_Job_Title` longtext NOT NULL,
  `Apply_Job_Type` varchar(255) NOT NULL,
  `Apply_Job_Location` varchar(255) NOT NULL,
  `Apply_Job_Salary` int(11) NOT NULL,
  `Apply_Job_Image` varchar(255) NOT NULL,
  `Apply_Job_Status` enum('Pending','Accept','Reject') NOT NULL DEFAULT 'Pending',
  `Apply_Job_DateTime` datetime NOT NULL,
  PRIMARY KEY (`Apply_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `js_apply` (`Apply_ID`, `Apply_Job_ID`, `Apply_Company_ID`, `Apply_Seeker_ID`, `Apply_Job_Title`, `Apply_Job_Type`, `Apply_Job_Location`, `Apply_Job_Salary`, `Apply_Job_Image`, `Apply_Job_Status`, `Apply_Job_DateTime`) VALUES
(1,	19,	1,	2,	'Software Developer',	'Full Time',	'Warangal',	50000,	'job14.jpg',	'Pending',	'2018-03-24 10:48:50'),
(2,	14,	1,	2,	'Product Manager',	'Part Time',	'Nellore',	30000,	'net-logo.png',	'Accept',	'2018-03-27 22:08:11'),
(3,	19,	1,	1,	'Software Developer',	'Full Time',	'Warangal',	50000,	'job14.jpg',	'Reject',	'2018-04-01 21:44:54');

DROP TABLE IF EXISTS `js_company`;
CREATE TABLE `js_company` (
  `Company_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Company_Unique_ID` varchar(255) NOT NULL,
  `Company_Email` varchar(255) NOT NULL,
  `Company_Password` varchar(255) NOT NULL,
  `Company_Name` varchar(255) NOT NULL,
  `Company_Address` longtext NOT NULL,
  `Company_Phone` varchar(255) NOT NULL,
  `Company_Bio` longtext NOT NULL,
  `Company_Emp_Num` int(11) NOT NULL,
  `Company_Estd_On` varchar(255) NOT NULL,
  `Company_Website` varchar(255) NOT NULL,
  `Company_Photo` varchar(255) NOT NULL,
  `Company_Status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `Company_Last_Login` datetime NOT NULL,
  `Company_Regd_On` datetime NOT NULL,
  PRIMARY KEY (`Company_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `js_company` (`Company_ID`, `Company_Unique_ID`, `Company_Email`, `Company_Password`, `Company_Name`, `Company_Address`, `Company_Phone`, `Company_Bio`, `Company_Emp_Num`, `Company_Estd_On`, `Company_Website`, `Company_Photo`, `Company_Status`, `Company_Last_Login`, `Company_Regd_On`) VALUES
(1,	'FjyS5tn',	'support@cognizant.com',	'7c4a8d09ca3762af61e59520943dc26494f8941b',	'Cognizant Technology Solutions',	'Chennai, INDIA',	'9655368174',	'It\'s a Multinational Company in IT Industry',	60000,	'1988',	'https://cognizant.com',	'Cognizant_Technology_Solutions-logo-525DD9ECA8-seeklogo.com.png',	'Active',	'2018-04-02 17:12:43',	'2018-01-08 09:29:20');

DROP TABLE IF EXISTS `js_contact`;
CREATE TABLE `js_contact` (
  `Contact_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Contact_Name` varchar(255) NOT NULL,
  `Contact_Email` varchar(255) NOT NULL,
  `Contact_Subject` varchar(255) NOT NULL,
  `Contact_Message` longtext NOT NULL,
  `Contact_DateTime` datetime NOT NULL,
  PRIMARY KEY (`Contact_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `js_contact` (`Contact_ID`, `Contact_Name`, `Contact_Email`, `Contact_Subject`, `Contact_Message`, `Contact_DateTime`) VALUES
(1,	'Subhro Pramanik',	'subhro.pramanik7@gmail.com',	'Suggestions',	'If you got this mail, please reply me back a SMS, so I can able to know that mail is working.',	'2018-03-31 12:51:31'),
(2,	'Subhro Pramanik',	'subhro.pramanik7@gmail.com',	'Suggestions',	'If you got this mail, please reply me back a SMS, so I can able to know that mail is working.',	'2018-03-31 12:59:19');

DROP TABLE IF EXISTS `js_job`;
CREATE TABLE `js_job` (
  `Job_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Job_Unique_ID` varchar(255) NOT NULL,
  `Job_Company_ID` int(11) NOT NULL,
  `Job_Title` longtext NOT NULL,
  `Job_Description` longtext NOT NULL,
  `Job_Category` varchar(255) NOT NULL,
  `Job_Type` varchar(255) NOT NULL,
  `Job_Location` varchar(255) NOT NULL,
  `Job_Education_Skill` varchar(255) NOT NULL,
  `Job_Technical_Skill` varchar(255) NOT NULL,
  `Job_Salary` int(11) NOT NULL,
  `Job_Post_Require` int(11) NOT NULL,
  `Job_Image` varchar(255) NOT NULL,
  `Job_Status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `Job_Posted_On` datetime NOT NULL,
  PRIMARY KEY (`Job_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `js_job` (`Job_ID`, `Job_Unique_ID`, `Job_Company_ID`, `Job_Title`, `Job_Description`, `Job_Category`, `Job_Type`, `Job_Location`, `Job_Education_Skill`, `Job_Technical_Skill`, `Job_Salary`, `Job_Post_Require`, `Job_Image`, `Job_Status`, `Job_Posted_On`) VALUES
(1,	'Egw5hxo',	1,	'Software Engineer ',	'\nSoftware engineers are primarily in charge of system design. They analyze the budget and requirements of the customer and apply the principles of software engineering to come up with the design, development, testing, and maintenance of the software or application. Software engineers are often confused with programmers but the two may differ in roles. The former focuses on the design of the software, while the latter writes the code that runs the software.',	'Engineering',	'Full Time',	'Bengaluru/Bangalore',	'College Degree, Computer Programming, Logical and Structured Thinking, Core Programming Language.',	'Experience with database management tools .  Should be proficient in a programming language, such as Java, Python, PHP, or JavaScript.',	35000,	20,	'brillio-off-campus-drive.jpg',	'Active',	'2018-01-14 09:47:44'),
(2,	'HWAg93r',	1,	'Developer ',	'Also known as a software developer, programmer, software coder, or software engineer, a developer plays a key role in designing, installing, testing, and maintaining all software applications. A developer is well-versed in at least one programming language and is proficient in structuring and writing code for a software or program. This person also writes, debugs, and executes the source code of a software application. This person works closely with a project manager or designer to ensure that the final product adheres to the budget, scope, and design.',	'Design',	'Full Time',	'Chennai',	'Bachelor\'s degree, typically in computer science.',	'The candidate must have top-notch programming skills and in-depth knowledge of a programming language, such as HTML/CSS, Java, JSP, PHP, ASP.NET, MVC, AJAX and JavaScript. ',	32580,	15,	'kekus-digital-sotware-logo.png',	'Active',	'2018-01-14 10:01:09'),
(3,	'9eXkJDn',	1,	'Front End Developer',	'The front end developer is in charge of managing the complex details of the front end side of the project that requires analyzing the design requirements as well as recommending technical solutions to make the project scalable, maintainable, and efficient. They debug websites and fix mistakes in the code to make sure that they are error-free for network administrators and the end users. Front end developers have working knowledge of several programming languages and they can adapt to new software versions to bring the designerâ€™s concept to life.',	'Teaching',	'Part Time',	'Guntur',	'Are fluent in the essential front-end web development languages, i.e., HTML, CSS and JavaScript. Are skilled in modern application programming languages, such as Java, .Net, AJAX, PHP, XHTML and Ruby. Use Adobe Creative Suite programs, e.g., Photoshop, Il',	'HTML/CSS. I know, these two terms keep coming up. ... JavaScript/jQuery. Another MAJOR tool in your front end developer toolbox is going to be JavaScript (JS). ... CSS and JavaScript Frameworks. ... CSS Preprocessing. ... Version Control/Git. Responsive D',	38560,	100,	'jr-dev-jobs-logo-square-500.png',	'Active',	'2018-01-14 12:48:17'),
(4,	'7iuF4d8',	1,	'Product Manager',	'Software product managers are in charge of managing the development of software products and communicating with the relevant internal and external parties. They act as a conduit among the development team, operations team, and end users. They also work with the marketing team to accurately and effectively present software features and business plans to current and prospective customers to make sure that the software product meets their needs. Moreover, they listen to feedbacks and gather user input to prioritize software requirements, review correct implementation, help with training tasks, and attend industry meetings to stay on top of the current trends and to adapt to newer technologies.',	'Business Development',	'Full Time',	'Delhi',	'Education Required. The education level required to apply for many product manager positions is a bachelor\'s degree in business or a related field. Typical areas of study for aspiring product managers include communications, marketing, economics, public r',	'Software product managers are in charge of managing the development of software products and communicating with the relevant internal and external parties. They act as a conduit among the development team, operations team, and end users. ',	40860,	122,	'ppp.png',	'Active',	'2018-01-14 12:59:09'),
(5,	'fW7ViHP',	1,	'.NET Developer',	'A .NET developer writes and modifies codes to generate web pages and access databases and business logo servers. The operate within the .NET environment using .NET languages such as C# or VB.NET and .NET stacks like WinForms, ASP.NET, WPF, etc. They also test and document software for websites and work with designers and content producers.\n\n',	'Strategy',	'Full Time',	'kakinada',	'The ideal candidate must have experience working in the .NET framework and should be proficient in one or both .NET languages . In addition, the person should be able to revise, update, refactor, and debug code to test and deploy applications and systems.',	'ASP.NET, ASP.NET MVC, .NET MVC (Model View Controller), EF, Entity Framework, ADO.NET Entity Framework, Windows Communication Foundation, WCF, SOA, Service-Oriented Architecture.',	49652,	200,	'net-logo.png',	'Active',	'2018-01-14 13:07:10'),
(6,	'DNcmy7z',	1,	'Java Developer',	'Java Developers create complex web-based applications such as animated drop-down menus, images that change as a mouse moves around them, and sounds that play when clicked. They write code themselves or revise existing Java applications and test programs to verify if they work correctly. They often mentor and provide technical guidance and instructions to lower level IT staff. Java developers also resolve technical problems through debugging, research, and investigation.',	'Procurement',	'Full Time',	'Vasco Da Gama',	'The candidate should have strong knowledge and experience with Spring, SpringBatch, Struts, Hibernate, XML, JSP, databases, SQL, ORM, Java, JSF, Wicket, Spring MVC, and other applications using the Java EE platforms. ',	'JSP / Servlets. Web Frameworks like Struts / Spring. Service Oriented Architecture / Web Services - SOAP / REST. Web Technologies like HTML, CSS, Javascript and JQuery. Markup Languages like XML and JSON.',	60230,	222,	'java.jpg',	'Active',	'2018-01-14 13:12:48'),
(7,	'M23xC9t',	1,	'Web Developer',	'Web developers build the backbone of websites. They are responsible for designing, coding, and modifying websites, from the layout to the function in accordance with the clientâ€™s specifications. Web developers have regular exposure to business stakeholders and management level employees. Since they need to build websites from the ground up, they need to pay attention to details and meet tight deadlines.',	'Automotive',	'Part Time',	'Anantapur',	'This career generally requires a bachelor\'s degree that is related to computer science, although exceptions may be made for those with the required skills and professional experience. These professionals also must possess an understanding of programming l',	'The candidate should have deep expertise and hands-on experience with web applications like REST and SOAP, as well as in programming languages like HTML, CSS, JavaScript, JQuery, and APIs. The person should also have high standards for quality, the passio',	52300,	25,	'new_google_logo2-818x342.jpg',	'Active',	'2018-01-14 13:18:04'),
(8,	'N9a6Hkf',	1,	'Quality Assurance Engineer',	'A quality assurance engineer (also called a test engineer) creates tests to find any problem with the software before the product is launched. The person identifies and analyzes bugs found during testing and documents them. The quality assurance engineer also collaborates with the software developer to find a fix and patch the program. They also liaise with the internal team to identify any system requirements. This person is also responsible for monitoring debugging process results, recommending process improvement, and tracking quality assurance metrics.\r\n\r\n',	'Accounting',	'Full Time',	'Chennai',	'The candidate should have strong knowledge of software QA methodologies, tools, and processes and hands-on experience with automated testing tools. The person should also have solid knowledge of SQL, scripting, and software development. In addition, the q',	'Experience with database management tools .  Should be proficient in a programming language, such as Java, Python, PHP, or JavaScript.',	36520,	965,	'elavate.gif',	'Active',	'2018-01-14 13:24:42'),
(9,	'r4RTOJi',	1,	'Software Developer',	'Software developer is another term for developer. Both perform the same functions like development of computer applications that allow users to perform specific tasks on computers and other devices. Software developers can also develop or customize existing systems that run devices or control networks. They work closely with analysts, designers, and IT staff. They may also test the product before it goes live.\n\n',	'Pharmaceutical',	'Full Time',	'Mumbai',	'College Degree, Computer Programming, Logical and Structured Thinking, Core Programming Language.',	'Experience with database management tools .  Should be proficient in a programming language, such as Java, Python, PHP, or JavaScript.',	42560,	420,	'resolweb-development.png',	'Active',	'2018-01-14 13:28:11'),
(10,	'KyZzDmu',	1,	'Application Developer',	'Application developers help companies keep up with the latest technologies and developments on the web. They create, develop, manage, and maintain new programs and software that can be used on smartphones, computers, tablets, and more. Application developers work closely with computer analysts, engineers, and IT professionals to set specifications for new applications. They write high quality source code to program complete applications and conduct functional and nonfunctional testing before launching.\r\n\r\n',	'Professional Services',	'Full Time',	'Kolkata',	'College Degree, Computer Programming, Logical and Structured Thinking, Core Programming Language.',	'The candidate must have the ability to program using different programming languages such as HTML, CSS, JavaScript, JQuery, and APIâ€™s. In addition, the person should have experience with code optimization, performance analysis, and developing implementa',	56203,	365,	'php.jpg',	'Active',	'2018-01-14 13:32:47'),
(11,	'pRVSIu3',	1,	'Account Executive',	'Some titles exist in virtually every aspect of every industry, such as administrative assistant, office manager, branch manager, and operations manager. Others are specific to certain divisions that most, but not all, businesses have, such as accounting or human relations or resources, while others are specific to a certain industry, such as finance or insurance. The following is a brief overview of some of the major categories.',	'Accounting',	'Full Time',	'Hyderabad/Secunderabad',	'College Degree, Computer Programming, Logical and Structured Thinking, Core Programming Language.',	'The candidate must have top-notch programming skills and in-depth knowledge of a programming language, such as HTML/CSS, Java, JSP, PHP, ASP.NET, MVC, AJAX and JavaScript. ',	43125,	600,	'android1.png',	'Active',	'2018-01-14 13:37:09'),
(12,	'P90HtA7',	1,	'IT and Digital Media',	'Common titles include webmaster, social media manager, and systems administrator. Because some of these positions are relatively new, titles are far from standardized and can be somewhat creative, such as social media guru. Software development companies employ people in a variety of positions, such as full stack developer, mobile developer, and software engineer.\r\n\r\n',	'General Business',	'Full Time',	'Anand',	'Bachelor\'s degree, typically in computer science.',	'HTML/CSS. I know, these two terms keep coming up. ... JavaScript/jQuery. Another MAJOR tool in your front end developer toolbox is going to be JavaScript (JS). ... CSS and JavaScript Frameworks. ... CSS Preprocessing. ... Version Control/Git. Responsive D',	25300,	150,	'inner-banner2.jpg',	'Active',	'2018-01-14 13:41:24'),
(13,	'ubEFUAe',	1,	'Webmaster',	'The front end developer is in charge of managing the complex details of the front end side of the project that requires analyzing the design requirements as well as recommending technical solutions to make the project scalable, maintainable, and efficient. They debug websites and fix mistakes in the code to make sure that they are error-free for network administrators and the end users. Front end developers have working knowledge of several programming languages and they can adapt to new software versions to bring the designerÃ¢â‚¬â„¢s concept to life.',	'QA',	'Part Time',	'Chandigarh',	'Education Required. The education level required to apply for many product manager positions is a bachelor\'s degree in business or a related field. Typical areas of study for aspiring product managers include communications, marketing, economics, public r',	'Education Required. The education level required to apply for many product manager positions is a bachelor\'s degree in business or a related field. Typical areas of study for aspiring product managers include communications, marketing, economics, public r',	25000,	333,	'job14.jpg',	'Active',	'2018-01-14 18:15:38'),
(14,	'xILwKCz',	1,	'Product Manager',	'Java Developers create complex web-based applications such as animated drop-down menus, images that change as a mouse moves around them, and sounds that play when clicked. They write code themselves or revise existing Java applications and test programs to verify if they work correctly. They often mentor and provide technical guidance and instructions to lower level IT staff. Java developers also resolve technical problems through debugging, research, and investigation.',	'Human Resources',	'Part Time',	'Nellore',	'Education Required. The education level required to apply for many product manager positions is a bachelor\'s degree in business or a related field. Typical areas of study for aspiring product managers include communications, marketing, economics, public r',	'Software product managers are in charge of managin...',	30000,	500,	'net-logo.png',	'Active',	'2018-01-14 18:20:37'),
(15,	'fMANgUb',	1,	'.NET Developer',	'A .NET developer writes and modifies codes to generate web pages and access databases and business logo servers. The operate within the .NET environment using .NET languages such as C# or VB.NET and .NET stacks like WinForms, ASP.NET, WPF, etc. They also test and document software for websites and work with designers and content producers.\r\n\r\n',	'Admin & Clerical',	'Full Time',	'Itanagar',	'Are fluent in the essential front-end web development languages, i.e., HTML, CSS and JavaScript. Are skilled in modern application programming languages, such as Java, .Net, AJAX, PHP, XHTML and Ruby. Use Adobe Creative Suite programs, e.g., Photoshop, Il',	'Are fluent in the essential front-end web development languages, i.e., HTML, CSS and JavaScript. Are skilled in modern application programming languages, such as Java, .Net, AJAX, PHP, XHTML and Ruby. Use Adobe Creative Suite programs, e.g., Photoshop, Il',	56000,	400,	'job17.png',	'Active',	'2018-01-14 18:23:13'),
(16,	'u2ZdEli',	1,	'IT and Digital Media',	'The front end developer is in charge of managing the complex details of the front end side of the project that requires analyzing the design requirements as well as recommending technical solutions to make the project scalable, maintainable, and efficient. They debug websites and fix mistakes in the code to make sure that they are error-free for network administrators and the end users. Front end developers have working knowledge of several programming languages and they can adapt to new software versions to bring the designerÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢s concept to life.',	'Professional Services',	'Full Time',	'Rajahmundry',	'Education Required. The education level required to apply for many product manager positions is a bachelor\'s degree in business or a related field. Typical areas of study for aspiring product managers include communications, marketing, economics, public r',	'Education Required. The education level required to apply for many product manager positions is a bachelor\'s degree in business or a related field. Typical areas of study for aspiring product managers include communications, marketing, economics, public r',	40000,	300,	'job16.png',	'Active',	'2018-01-14 18:26:27'),
(17,	'0EKcyXx',	1,	'Application Developer',	'Also known as a software developer, programmer, software coder, or software engineer, a developer plays a key role in designing, installing, testing, and maintaining all software applications. A developer is well-versed in at least one programming language and is proficient in structuring and writing code for a software or program. This person also writes, debugs, and executes the source code of a software application. This person works closely with a project manager or designer to ensure that the final product adheres to the budget, scope, and design.',	'Broadcast',	'Full Time',	'Silchar',	'Bachelor\'s degree, typically in computer science.',	'The candidate must have top-notch programming skills and in-depth knowledge of a programming language, such as HTML/CSS, Java, JSP, PHP, ASP.NET, MVC, AJAX and JavaScript. ',	45203,	600,	'job15.jpg',	'Active',	'2018-01-14 18:29:29'),
(18,	'buGRYXe',	1,	'Software Engineer ',	'\r\nSoftware engineers are primarily in charge of system design. They analyze the budget and requirements of the customer and apply the principles of software engineering to come up with the design, development, testing, and maintenance of the software or application. Software engineers are often confused with programmers but the two may differ in roles. The former focuses on the design of the software, while the latter writes the code that runs the software.',	'Accounting',	'Full Time',	'Bhagalpur',	'College Degree, Computer Programming, Logical and Structured Thinking, Core Programming Language.',	'College Degree, Computer Programming, Logical and Structured Thinking, Core Programming Language.',	45230,	324,	'graphynix-iphone-app-development.png',	'Active',	'2018-01-14 18:32:25'),
(19,	'fL1Sgw6',	1,	'Software Developer',	'Software developer is another term for developer. Both perform the same functions like development of computer applications that allow users to perform specific tasks on computers and other devices. Software developers can also develop or customize existing systems that run devices or control networks. They work closely with analysts, designers, and IT staff. They may also test the product before it goes live.\r\n\r\n',	'Professional Services',	'Full Time',	'Warangal',	'College Degree, Computer Programming, Logical and Structured Thinking, Core Programming Language.',	'HTML/CSS. I know, these two terms keep coming up. ... JavaScript/jQuery. Another MAJOR tool in your front end developer toolbox is going to be JavaScript (JS). ... CSS and JavaScript Frameworks. ... CSS Preprocessing. ... Version Control/Git. Responsive D',	50000,	500,	'job14.jpg',	'Active',	'2018-01-15 18:40:33'),
(20,	'7mE3aLX',	1,	'Webmaster',	'\r\nSoftware engineers are primarily in charge of system design. They analyze the budget and requirements of the customer and apply the principles of software engineering to come up with the design, development, testing, and maintenance of the software or application. Software engineers are often confused with programmers but the two may differ in roles. The former focuses on the design of the software, while the latter writes the code that runs the software.Webmaster',	'Accounting',	'Full Time',	'Raipur',	'College Degree, Computer Programming, Logical and Structured Thinking, Core Programming Language.',	'Experience with database management tools .  Should be proficient in a programming language, such as Java, Python, PHP, or JavaScript.',	35260,	300,	'job16.png',	'Active',	'2018-01-15 20:12:25'),
(21,	'HpD2Zlt',	1,	'Application Developer',	'\r\nSoftware engineers are primarily in charge of system design. They analyze the budget and requirements of the customer and apply the principles of software engineering to come up with the design, development, testing, and maintenance of the software or application. Software engineers are often confused with programmers but the two may differ in roles. The former focuses on the design of the software, while the latter writes the code that runs the software.',	'Government',	'Full Time',	'Panjim/Panaji',	'College Degree, Computer Programming, Logical and Structured Thinking, Core Programming Language.',	'HTML/CSS. I know, these two terms keep coming up. ... JavaScript/jQuery. Another MAJOR tool in your front end developer toolbox is going to be JavaScript (JS). ... CSS and JavaScript Frameworks. ... CSS Preprocessing. ... Version Control/Git. Responsive D',	55000,	456,	'job1.jpg',	'Active',	'2018-01-15 20:15:36');

DROP TABLE IF EXISTS `js_seeker`;
CREATE TABLE `js_seeker` (
  `Seeker_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Seeker_Unique_ID` varchar(255) NOT NULL,
  `Seeker_Email` varchar(255) NOT NULL,
  `Seeker_Password` varchar(255) NOT NULL,
  `Seeker_Name` varchar(255) NOT NULL,
  `Seeker_Address` longtext NOT NULL,
  `Seeker_Gender` varchar(255) NOT NULL,
  `Seeker_Phone` varchar(255) NOT NULL,
  `Seeker_Education` longtext NOT NULL,
  `Seeker_Skill` longtext NOT NULL,
  `Seeker_Experience` longtext NOT NULL,
  `Seeker_Bio` longtext NOT NULL,
  `Seeker_Hobby` longtext NOT NULL,
  `Seeker_Photo` varchar(255) NOT NULL,
  `Seeker_CV` varchar(255) NOT NULL,
  `Seeker_Status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `Seeker_Last_Login` datetime NOT NULL,
  `Seeker_Regd_On` datetime NOT NULL,
  PRIMARY KEY (`Seeker_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `js_seeker` (`Seeker_ID`, `Seeker_Unique_ID`, `Seeker_Email`, `Seeker_Password`, `Seeker_Name`, `Seeker_Address`, `Seeker_Gender`, `Seeker_Phone`, `Seeker_Education`, `Seeker_Skill`, `Seeker_Experience`, `Seeker_Bio`, `Seeker_Hobby`, `Seeker_Photo`, `Seeker_CV`, `Seeker_Status`, `Seeker_Last_Login`, `Seeker_Regd_On`) VALUES
(1,	'm6RCIGQ',	'priyanka.pramanik0710@gmail.com',	'7c4a8d09ca3762af61e59520943dc26494f8941b',	'Priyanka Pramanik',	'Topkhanapara, Santipur, 741404 ',	'Female',	'8609362282',	'B.Sc.(Major)',	'PHP, JavaScript, jQuery, AJAX, HTML, CSS, HTML5, CSS3, AngularJS, MySQL, MongoDB, Laravel',	'61',	'Hello, I\'m Priyanka Pramanik from Santipur. I\'m an Application Developer in XYZ Technolgy Pvt. Ltd. Company located in Kolkata. I am working here for last 1 year.',	'Watching Movies, Music, Playing Online Games',	'IMG_4357.JPG',	'priyanka pramanik cv.docx',	'Active',	'2018-04-01 22:23:52',	'2018-01-08 09:04:10'),
(2,	'Mxobj0B',	'priyanka.pramanik710@gmail.com',	'7c4a8d09ca3762af61e59520943dc26494f8941b',	'Priya Pramanik',	'Dabrepara',	'Female',	'9685741230',	'B.Sc. (Major)',	'PHP, HTML, JavaScript, CSS, jQuery, AJAX',	'43',	'I am a Web Developer',	'Listening Music',	'IMG_4357.JPG',	'priyanka pramanik cv.docx',	'Active',	'2018-04-01 21:44:23',	'2018-01-11 17:10:16'),
(3,	'xVDoUJy',	'souvikdebnath1997@gmail.com',	'40c5169448af7279279c2b4041455ee4b0ab5cd1',	'Souvik Debnath',	'santipur',	'Male',	'9876543210',	'B.SC. PHYSIC(H)',	'FGH',	'73',	'student',	'FOOTBALL',	'FF.jpg',	'priyanka pramanik cv.docx',	'Inactive',	'0000-00-00 00:00:00',	'2018-01-11 18:10:30'),
(4,	'vPoNqeC',	'karandebnath581@gmail.com',	'f18f057ea44a945a083a00e6fcc11637d186042d',	'karan Debnath',	'chakdah',	'Male',	'9876543210',	'wsdefrgthjk',	'erftghyujik',	'13',	'student',	'dance',	'FF.jpg',	'priyanka pramanik cv.docx',	'Inactive',	'0000-00-00 00:00:00',	'2018-01-11 18:17:11');

-- 2018-04-02 18:43:22
