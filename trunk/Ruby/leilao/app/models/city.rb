class City < ActiveRecord::Base
	belongs_to :states
	has_many :clients
	
	validates :state_id, :presence => true
	validates :name, :presence => true, :length => {:minimum => 2, :maximum => 100 }
end
