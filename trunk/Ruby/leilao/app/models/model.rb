class Model < ActiveRecord::Base
	belongs_to :assembler
	has_many :cars

	validates :assembler_id, :presence => true
	validates :name, :presence => true, :uniqueness => true

	default_scope :order => 'name ASC'
end
