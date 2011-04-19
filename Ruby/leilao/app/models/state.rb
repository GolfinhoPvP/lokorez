class State < ActiveRecord::Base
	has_many :cities

	validates :name, :presence => true, :uniqueness => true, :length => {:minimum => 2, :maximum => 50 }
	validates :acronym, :presence => true, :uniqueness => true, :length => {:minimum => 1, :maximum => 2}, :format => { :with => /^[a-zA-Z]{2,2}$/ }
end
