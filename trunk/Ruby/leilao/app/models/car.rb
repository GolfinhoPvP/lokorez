class Car < ActiveRecord::Base
	has_one :auctions
	has_many :models
	has_and_belongs_to_many :fuels
	has_and_belongs_to_many :optionals
	has_one :concessionaires

	validates :model_id, :presence => true
	validates :engine, :presence => true
	validates :plate, :presence => true, :uniqueness => true,  :format => { :with => /^[a-zA-Z]{3,3}-[0-9]{4,4}$/ }
	validates :colour, :presence => true
	validates :mileage, :presence => true, :format => { :with => /^[0-9]+$/ }
	validates :manufacture_year, :presence => true, :format => { :with => /^[0-9]{4,4}/ }
	validates :model_year, :presence => true, :format => { :with => /^[0-9]{4,4}$/ }
end
