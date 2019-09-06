USE [jcypqm]
GO
/****** Object:  Table [dbo].[qan_machinebreakdown]    Script Date: 11/7/2018 10:58:38 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[qan_machinebreakdown](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[created_date] [datetime] NULL,
	[modified_date] [datetime] NULL,
	[is_deleted] [tinyint] NULL
) ON [PRIMARY]
GO
