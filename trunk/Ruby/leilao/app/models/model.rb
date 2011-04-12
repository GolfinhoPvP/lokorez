class Model < ActiveRecord::Base
	belongs_to :assemblers
	belongs_to :cars

	validates :name, :presence => true, :uniqueness => true
end
