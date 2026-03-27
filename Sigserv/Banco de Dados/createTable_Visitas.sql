CREATE TABLE Visitas  (
	[Codigo] [int] IDENTITY NOT NULL,
	[Cod_Cliente][int] NULL,
	[Cod_OS][int] NULL,
	[Dt_Criacao][datetime] NULL,
	[Dt_Expiracao][datetime] NULL,
	[Dt_Prox_Visita][datetime] NULL,
	[Hora_Prox_Visita][datetime] NULL,
	[Obs][varchar](2500) NULL
	CONSTRAINT pkVisitas PRIMARY KEY (Codigo)
) ON [PRIMARY]