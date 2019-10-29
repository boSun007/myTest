import java.util.HashMap;
import java.util.Map;

public class kvArray{
 
    public static void main(String[] args)  
    {  
        Map<String,Integer> m = new HashMap<String,Integer>();  
          
        m.put("zhangsan", 19);  
        m.put("lisi", 49);
        m.put("wangwu", 19);  
        m.put("lisi",20);  
        m.put("hanmeimei", null);         
        System.out.println(m);  
          
        System.out.println(m.remove("wangwu"));  
          
        m.clear();  
		System.out.println(m);
		
		Map<String,String> n = new HashMap<String,String>();  
          
        n.put("zhangsan", "name");  
        n.put("lisi", "name");
        n.put("wangwu", "19");  
        n.put("lisi","name");  
        n.put("hanmeimei", null);         
        System.out.println(n.get("zhangsan"));  
          
        // System.out.println(n.remove("wangwu"));  
          
        // m.clear();  
		// System.out.println(n);
		
    }  

}
