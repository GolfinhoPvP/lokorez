class Assembler < ActiveRecord::Base
	has_many :models

	validates :name, :presence => true, :uniqueness => true
end
