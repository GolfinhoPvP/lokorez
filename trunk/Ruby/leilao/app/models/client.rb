class Client < ActiveRecord::Base
	belongs_to :cities
	has_and_belongs_to_many :auctions

	validates :cpf, :presence => true, :uniqueness => true, :length => {:minimum => 14, :maximum => 14 }
	validates :city_id, :presence => true
	validates :name, :presence => true, :length => {:minimum => 2, :maximum => 100 }
end
