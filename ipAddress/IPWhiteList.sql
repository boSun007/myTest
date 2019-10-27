USE [Serenity]
GO

/****** Object:  Table [dbo].[IPWhiteList]    Script Date: 22/08/2019 14:21:05 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[IPWhiteList](
	[WLID] [bigint] IDENTITY(1,1) NOT NULL,
	[XMLBookingLoginID] [varchar](max) NOT NULL,
	[WLIPStart] [bigint] NULL,
	[WLIPEnd] [bigint] NULL,
	[WLIPTag] [varchar](50) NULL,
	[WLStatus] [bit] NOT NULL,
 CONSTRAINT [PK_IPWhiteList] PRIMARY KEY CLUSTERED 
(
	[WLID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [dbo].[IPWhiteList] ADD  CONSTRAINT [DF_IPWhiteList_WLIPTag]  DEFAULT ('production') FOR [WLIPTag]
GO

ALTER TABLE [dbo].[IPWhiteList] ADD  CONSTRAINT [DF_IPWhiteList_WLStatus]  DEFAULT ((1)) FOR [WLStatus]
GO


