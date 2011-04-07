class Cidade < ActiveRecord::Base
	validates_presence_of :cid_codigo, :message => "deve ser preenchido"
	validates_presence_of :est_codigo, :message => "deve ser preenchido"
	validates_presence_of :cid_nome, :message => "deve ser preenchido"
	validates_numericality_of :cid_codigo, :message => "deve ser numerico"
	validates_numericality_of :est_codigo, :message => "deve ser numerico"

	validates_uniqueness_of :cid_codigo, :message => "deve ser unico"
	
	has_many :clientes
end
