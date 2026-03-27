namespace Servico.Models
{
    using System;
    using System.Collections.Generic;
    using System.ComponentModel.DataAnnotations;
    using System.ComponentModel.DataAnnotations.Schema;
    using System.Data.Entity.Spatial;

    public partial class USUARIOS
    {
        [Key]
        [Column(TypeName = "numeric")]
        [DatabaseGenerated(DatabaseGeneratedOption.Identity)]
        public decimal CODIGO { get; set; }

        [StringLength(50)]
        public string NOME { get; set; }

        [StringLength(20)]
        public string LOGIN { get; set; }
    }
}
