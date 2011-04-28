module ApplicationHelper
	def main_menu
		menu = %w(assembler auction bid car city client concessionaire fuel model optional role state)
		main_menu = "<ul>"
		main_menu << "<li>" + link_to("Cadastrar", "users/sign_up") + "</li>"
		menu.each do |iten|
			main_menu << "<li>" + link_to(iten, :controller => iten.pluralize) + "</li>"
		end
		main_menu << "</ul>"
		raw main_menu
	end
end
