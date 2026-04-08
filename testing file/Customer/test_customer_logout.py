from selenium import webdriver
from selenium.webdriver.common.by import By
import time

driver = webdriver.Chrome()

try:
   
    print("Authenticating session...")
    driver.get("http://localhost/Bakery_Hub_new/common/View/login.php")
    driver.maximize_window()
    driver.find_element(By.ID, "email").send_keys("test@gmail.com")
    driver.find_element(By.ID, "password").send_keys("123456")
    driver.find_element(By.XPATH, "//button[@type='submit']").click()
    time.sleep(2) 
    
    
    print("Executing Feature 4: Logout Test")
    logout_link = driver.find_element(By.LINK_TEXT, "Logout")
    logout_link.click()
    
    print("Logout executed successfully.")
    time.sleep(2)

except Exception as e:
    print(f"Script failed: {e}")
finally:
    driver.quit()