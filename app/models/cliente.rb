class Cliente < ActiveRecord::Base
	validates_uniqueness_of :cli_cpf, :message => "deve ser unico"

	belongs_to :cidades
end
