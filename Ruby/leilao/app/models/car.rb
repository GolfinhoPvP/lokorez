class Car < ActiveRecord::Base
	belongs_to :auctions
	has_many :models
	has_and_belongs_to_many :fuels
	has_and_belongs_to_many :optionals

	validates :mod_code, :presence => true
	validates :engine, :presence => true
	validates :plate, :presence => true, :uniqueness => true,  :format => { :with => /^[a-zA-Z]{3,3}-[0-9]{4,4}$/ }
	validates :colour, :presence => true
	validates :mileage, :presence => true, :format => { :with => /^[0-9]+$/ }
	validates :manufacture_year, :presence => true, :format => { :with => /^[0-9]{4,4}/ }
	validates :model_year, :presence => true, :format => { :with => /^[0-9]{4,4}$/ }
end
