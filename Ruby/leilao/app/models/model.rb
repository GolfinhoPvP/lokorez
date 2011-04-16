class Model < ActiveRecord::Base
	belongs_to :assemblers
	belongs_to :cars

	validates :assembler_id, :presence => true
	validates :name, :presence => true, :uniqueness => true

	default_scope :order => 'name ASC'
end
