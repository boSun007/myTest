USE [Serenity]
GO

/****** Object:  Table [dbo].[TransactionBlc]    Script Date: 24/10/2019 12:00:15 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[TransactionBlc](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[Customer] [varchar](50) NULL,
	[Amount] [float] NULL,
	[Currency] [varchar](50) NULL,
	[Email] [varchar](50) NULL,
	[Address] [varchar](50) NULL,
	[City] [varchar](50) NULL,
	[Tel] [varchar](50) NULL,
	[Postcode] [varchar](50) NULL,
	[Country] [varchar](50) NULL,
	[PSPID] [varchar](50) NULL,
	[SHAsigh] [varchar](100) NULL,
	[SHAsignForm] [varchar](100) NULL,
	[TransTime] [int] NOT NULL
) ON [PRIMARY]
GO


