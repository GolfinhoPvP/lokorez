class Model < ActiveRecord::Base
	belongs_to :assemblers
	belongs_to :cars

	validates :ass_code, :presence => true
	validates :name, :presence => true, :uniqueness => true
end
