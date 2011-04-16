class Assembler < ActiveRecord::Base
	has_many :models

	validates :name, :presence => true, :uniqueness => true

	default_scope :order => 'name ASC'
end
