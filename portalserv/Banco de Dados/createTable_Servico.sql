CREATE TABLE Servico  (
	[Codigo] [int] IDENTITY NOT NULL,
	[Tipo_Serv][varchar](100) NULL
	CONSTRAINT pkServico PRIMARY KEY (Codigo)
) ON [PRIMARY]