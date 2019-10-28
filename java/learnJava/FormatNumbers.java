import java.text.NumberFormat;

public class FormatNumbers{
	public static void main(String[] args){
		NumberFormat currency = NumberFormat.getCurrencyInstance();
		String result = currency.format(12342134.12312312);
		NumberFormat percent = NumberFormat.getPercentInstance();
		String result1 = percent.format(0.123);
		System.out.println(result);
		System.out.println(result1);
	}
}


		
