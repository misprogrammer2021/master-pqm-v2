USE [JCYPQM]
GO
/****** Object:  User [pqm]    Script Date: 29/10/2018 12:00:41 AM ******/
CREATE USER [pqm] FOR LOGIN [pqm] WITH DEFAULT_SCHEMA=[dbo]
GO
ALTER ROLE [db_owner] ADD MEMBER [pqm]
GO
/****** Object:  Table [dbo].[settings]    Script Date: 29/10/2018 12:00:41 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[settings](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[setting] [varchar](50) NULL,
	[value] [varchar](max) NULL,
	[created_date] [datetime] NOT NULL,
	[modified_date] [datetime] NOT NULL,
	[is_deleted] [tinyint] NOT NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[user_login_token]    Script Date: 29/10/2018 12:00:42 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[user_login_token](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[user_id] [char](36) NULL,
	[token] [varchar](max) NULL,
	[created_date] [datetime] NOT NULL,
	[modified_date] [datetime] NOT NULL,
	[is_deleted] [tinyint] NOT NULL,
	[expired] [varchar](50) NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[role]    Script Date: 11/19/2018 3:44:19 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[role](
	[id] [int] NOT NULL,
	[name] [varchar](50) NULL,
	[role_id] [int] NULL,
 CONSTRAINT [PK_role] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

